<?php
    include('db.php');
    $database = new Database();
    $conn = $database->getConnection();

    if(count($_POST) > 0){
        if($_POST['type'] == 1){
            $schedule_id = $_POST['schedule_id'];
            $passenger_id = $_POST['passenger_id'];
            $passenger_email = $_POST['passenger_email']; // This variable is not used in the query
            $seat_num = $_POST['seat_num'];
            $payment_status = "pending";
            $total = $_POST['total'];
            $routeName = $_POST['routeName'];
            $book_reference = $routeName."_00".$schedule_id."00".$seat_num;
            $fare = $_POST['fare']; // Fare per seat
            $discount = $_POST['discount']; // Discount applied

            // Get passenger type from POST
            $passenger_type = $_POST['passenger_type'];

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO `tblbook` (`schedule_id`, `passenger_id`, `seat_num`, `payment_status`, `total`, `book_reference`, `passenger_type`, `fare`, `discount`) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind parameters
            $stmt->bind_param("iisssssss", $schedule_id, $passenger_id, $seat_num, $payment_status, $total, $book_reference, $passenger_type, $fare, $discount);

            // Execute statement
            if ($stmt->execute()) {
                echo json_encode(array("statusCode" => 201));
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    }
?>
