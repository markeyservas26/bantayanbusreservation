<?php

$route_from = isset($_GET['route_from']) && !empty($_GET['route_from']) ? $_GET['route_from'] : "";
$route_to = isset($_GET['route_to']) && !empty($_GET['route_to']) ? $_GET['route_to'] : "";
$schedule_date = isset($_GET['schedule_date']) && !empty($_GET['schedule_date']) ? $_GET['schedule_date'] : "";

$database = new Database();
$db = $database->getConnection();

$new_location = new Location($db);
$locations = $new_location->getAll();
$location_from = $new_location->getByLocation($route_from);
$location_to = $new_location->getByLocation($route_to);

    class Location
    {
        private $conn;
        private $table_name = "tbllocation";

        // Database Connection 
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAll()
        {
            $query = "SELECT * FROM ".$this->table_name;
            $result = $this->conn->query($query);
            
            $data = array();
            while ($row = $result->fetch_assoc()) {
                   $data[] = $row;
            }
            return $data;
        }

        public function getById($id)
        {
            $query = "SELECT * FROM ".$this->table_name." WHERE id = '$id'";
            $result = $this->conn->query($query);
            $data = $result->fetch_assoc();
            return $data;
        }

        public function getByLocation($name)
        {
            $query = "SELECT * FROM ".$this->table_name." WHERE location_name = '$name'";
            $result = $this->conn->query($query);
            $data = $result->fetch_assoc();
            return $data;
        }
    }

    
?>