<?php
require_once("dbconnect.php");
class GenreModel extends DBConnect
{
    function __construct() {
        $this->connectDB();
    }
    function getAllGenres() {
        $query = "SELECT GenreName FROM genre";
        $result = $this->conn->query($query);
        $genres = array();
        if($result->num_rows > 0) {
            while($genre = mysqli_fetch_assoc($result)){
                $genres[] = $genre;
            }
        }
        return $genres;
    }

    function __destruct() {
        mysqli_close($this->conn);
    }
}
?>