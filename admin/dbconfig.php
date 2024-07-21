<?php
class Database {
    private $servername = "localhost";
    private $username = "u510162695_bobrs";
    private $password = "1Bobrs_password";
    private $dbname = "u510162695_bobrs";
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

        return $this->conn;
    }
}

// Usage example
$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "Connected successfully";
}
?>
