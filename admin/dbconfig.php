<?php
$servername = "127.0.0.1";
$username = "u510162695_bobrs";
$password = "1Bobrs_password";
$dbname = "u510162695_bobrs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
