<?php 
    include('includes/layout-header.php');
    
    if(isset($_SESSION["userId"])){
        header("location: account.php");
        exit;
    }
    
    include('controllers/db.php');
    include('controllers/passenger.php');

    $database = new Database();
    $db = $database->getConnection();

    if(isset($_POST["sign-up-submit"])){
        $new_passenger = new Passenger($db);
        
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        
        if(strlen($password) < 7) {
            $error = "Password must be at least 7 characters long.";
        } else {
            $new_passenger->create($first_name, $last_name, $email, $address, $password);
        }
    }
?>

<main>
    <div class="container mt-3">
        <div class="w-100 m-auto bg-white shadow-sm" style="max-width: 500px">
            <div class="bg-primary p-3" style="background-image: linear-gradient(-20deg, #b721ff 0%, #21d4fd 100%);">
                <h1 class="text-center">Create an Account</h1>
            </div>

            <div class="p-3" style="background: rgb(51,122,183); background: radial-gradient(circle, rgba(51,122,183,1) 0%, rgba(4,92,167,1) 50%, rgba(0,137,255,1) 100%);">
                <?php
                    if(isset($error)){
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    }
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emailExist"){
                            echo '<div class="alert alert-danger" role="alert">Email already exists.</div>';
                        }else if($_GET["error"] == "stmtfailed"){
                            echo '<div class="alert alert-danger" role="alert">Error creating an account.</div>';
                        }
                    }
                ?>

                <form method="POST" action="" >
                    <div class="form-group">
                         <label for="first_name" style="color: white; font-weight: bold">First Name</label>
                         <input type="text" class="form-control" id="first_name" name="first_name" required />
                    </div>
                    <div class="form-group">
                            <label for="last_name" style="color: white; font-weight: bold">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required />
                        </div>
                    <div class="form-group">
                        <label for="address" style="color: white; font-weight: bold">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required />
                    </div>
                    <div class="form-group">
                        <label for="email" style="color: white; font-weight: bold">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password" style="color: white; font-weight: bold">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required />
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-password">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" style="color: white; font-weight: bold">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-confirm-password">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block glow-button" name="sign-up-submit">Register</button>

                    <div class="text-center" style="color: white; font-weight: bold">
                        <span>Already have an account? </span>
                        <a href="login.php" style="color: cyan; font-weight: bold">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('includes/scripts.php')?>
<?php include('includes/layout-footer.php')?>

<script>
    document.querySelectorAll('.toggle-password').forEach(function(icon) {
        icon.addEventListener('click', function(e) {
            var passwordField = (icon.id === 'toggle-password') ? document.getElementById('password') : document.getElementById('confirm_password');
            var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            icon.querySelector('i').classList.toggle('fa-eye');
            icon.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.glow-button {
  position: relative;
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-image: linear-gradient(-20deg, #b721ff 0%, #21d4fd 100%);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  outline: none;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.glow-button:hover {
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
}

.glow-button:focus {
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
}
</style>
