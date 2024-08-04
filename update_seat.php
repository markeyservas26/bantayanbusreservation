<?php
// update_seat.php

// Include your database connection
include 'db_connection.php';

// Initialize response array
$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the POST data
    $book_id = $_POST['book_id'];
    $seat_num = $_POST['seat_num'];

    // Check if book_id and seat_num are provided
    if (!empty($book_id) && !empty($seat_num)) {
        // Update the seat number in the database
        $query = "UPDATE bookings SET seat_num = ? WHERE book_id = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('si', $seat_num, $book_id);
            if ($stmt->execute()) {
                $response['success'] = true;
            }
            $stmt->close();
        }
    }
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
