<?php
require_once("dbconnect.php");
class SongModel extends DBConnect
{
    function __construct() {
        $this->connectDB();
    }


    function getSongsByKeyword($keyword) {
        $query = "SELECT Title, artist.Name, genre.GenreName, song.Length, song.Path FROM song JOIN title ON song.TitleID=title.TitleID 
            JOIN artist ON artist.ArtistID=song.ArtistID
            JOIN genre ON genre.GenreID=title.GenreID
            WHERE Title LIKE '%$keyword%' OR artist.Name LIKE '%$keyword%'";
        $result = $this->conn->query($query);
        $songs = array();
        if($result->num_rows > 0) {
            while($song = mysqli_fetch_assoc($result)){
                $songs[] = $song;
            }
        }
        return $songs;
    }


    function __destruct() {
        mysqli_close($this->conn);
    }
}
?>