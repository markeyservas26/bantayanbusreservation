<?php
include('db.php');
$database = new Database();
$conn = $database->getConnection();

if (count($_POST) > 0) {
    if ($_POST['type'] == 1) {
        $schedule_id = $_POST['schedule_id'];
        $passenger_id = $_POST['passenger_id'];
        $passenger_email = $_POST['passenger_email'];
        $seat_num = $_POST['seat_num'];
        $payment_status = "pending";
        $total = $_POST['total'];
        $routeName = $_POST['routeName'];
        $book_reference = $routeName . "_00" . $schedule_id . "00" . $seat_num;

        // Get passenger type
        $passenger_type = $_POST['passenger_type'];

        // Initialize upload_id variable
        $upload_id_name = null;

        // Check if there's an uploaded file
        if (isset($_FILES['upload_id']) && $_FILES['upload_id']['error'] == 0) {
            $upload_id = $_FILES['upload_id'];
            $upload_id_name = uniqid() . '_' . basename($upload_id['name']); // Create a unique filename
            $upload_id_path = 'uploads/' . $upload_id_name; // Specify your upload directory

            // Move the uploaded file to the desired directory
            if (!move_uploaded_file($upload_id['tmp_name'], $upload_id_path)) {
                echo json_encode(array("statusCode" => 500, "message" => "Error uploading the file."));
                exit;
            }
        }

        // Update SQL query to include upload_id_name instead of upload_id
        $sql = "INSERT INTO `tblbooks` (`schedule_id`, `passenger_id`, `seat_num`, `payment_status`, `total`, `book_reference`, `passenger_type`, `upload_id`) 
                VALUES ('$schedule_id', '$passenger_id', '$seat_num', '$payment_status', '$total', '$book_reference', '$passenger_type', '$upload_id_name')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 201));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Error: " . mysqli_error($conn)));
        }
        mysqli_close($conn);
    }
}
?>
