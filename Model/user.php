<?php
require_once("dbconnect.php");
class UserModel extends DBConnect
{
    function __construct() {
        $this->connectDB();
    }
    function getAllUsers() {
        $query = "SELECT * from user";
        $result = $this->conn->query($query);
        $users = array();
        if($result->num_rows > 0) {
            while($user = mysqli_fetch_assoc($result)){
                $users[] = $user;
            }
        }
        return $users;
    }

    function authenticateUser($username, $password) {
        $query = " SELECT * from user WHERE UserName = '$username' AND PassWord='$password' ";
        $result = $this->conn->query($query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }


    function __destruct() {
        mysqli_close($this->conn);
    }
}
?>