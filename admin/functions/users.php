<?php
    // Check if any input is empty during registration
    function emptyInputRegister($name, $email, $username, $pwd, $pwdRepeat){
        return empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat);
    }

    // Validate the email address
    function validEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Check if passwords match
    function pwdMatch($pwd, $pwdRepeat){
        return $pwd === $pwdRepeat;
    }

    // Check if email or username already exists in the database
    function isEmailExist($conn, $email, $username){
        $sql = "SELECT * FROM tbluser WHERE email = ? OR username = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error preparing the statement.";
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            mysqli_stmt_close($stmt);
            return $row;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Create a new user with hashed password
    function createUser($conn, $name, $email, $username, $pwd){
        $sql = "INSERT INTO tbluser (fullname, email, username, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?page=users&error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../index.php?page=users");
        exit();
    }

    // Send a verification code to the user
    function sendVerificationCode($whom, $name, $verification_code){
        $subject = "Verification Code";
        $comment = "Hello, " . $name . "\n\nYour verification code is: " . $verification_code;

        mail($whom, $subject, $comment);
    }

    // Handle user login with email and password
    function loginUser($conn, $email, $pwd){
        $isExists = isEmailExist($conn, $email, "");

        if($isExists === false){
            echo json_encode(array("statusCode" => 404, "title" => "Invalid email or password."));
            exit();
        }

        // Verify the password using password_verify
        $checkPwd = password_verify($pwd, $isExists['password']);

        if($checkPwd === false){
            echo json_encode(array("statusCode" => 404, "title" => "Invalid email or password."));
            exit();
        } else if($checkPwd === true){
            // Check if the user account is active
            if($isExists['status'] === 0){
                echo json_encode(array("statusCode" => 404, "title" => "Unauthorized access."));
                exit();
            }

            session_start();
            
            // Store user data in session
            $_SESSION["userId"] = $isExists['id'];
            $_SESSION["userFname"] = $isExists['fullname'];
            $_SESSION["username"] = $isExists['username'];
            $_SESSION["userEmail"] = $isExists['email'];
            $_SESSION["userEmailVerifiedAt"] = $isExists['email_verified_at'] === null ? false : true;

            echo json_encode(array("statusCode" => 200));
            exit();
        }
    }

    // Update user status (activate or deactivate)
    function updateUserStatus($conn, $id, $status){
        $sql = "UPDATE tbluser SET status = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array("statusCode" => 500, "title" => "Failed to update status."));
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ii", $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo json_encode(array("statusCode" => 200));
        exit();
    }

    // Function to reset password (if applicable)
    function resetPassword($conn, $email, $newPwd){
        $sql = "UPDATE tbluser SET password = ? WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array("statusCode" => 500, "title" => "Failed to reset password."));
            exit();
        }

        $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo json_encode(array("statusCode" => 200));
        exit();
    }
?>
