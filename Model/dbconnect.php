<?php 
    class DBConnect {
        public $conn;

        function connectDB() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db_name = "albumdb";
            
            // Create connection
            $this->conn = new mysqli($servername, $username, $password, $db_name);
            // mysqli_set_charset($conn, "UTF8");

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // return $conn;
        }
    }
?>