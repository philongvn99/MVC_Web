<?php
require_once("dbconnect.php");
class ArtistModel extends DBConnect
{
    function __construct() {
        $this->connectDB();
    }

    function getAllArtists() {
        $query =    "SELECT ar.Name FROM
                        (SELECT count(*) AS song_count, ArtistID FROM song GROUP BY ArtistID) AS sc 
                        JOIN
                        artist AS ar 
                    ON sc.ArtistID = ar.ArtistID 
                    ORDER BY sc.song_count DESC
                    LIMIT 20";
        $result = $this->conn->query($query);
        $artists = array();
        if($result->num_rows > 0) {
            while($artist = mysqli_fetch_assoc($result)){
                $artists[] = $artist;
            }
        }
        return $artists;
    }

    function getArtistsByKeyword($keyword) {
        $query = "SELECT a.ArtistID, a.Name, a.ImagePath FROM artist a WHERE a.Name LIKE '%$keyword%'";
        $result = $this->conn->query($query);
        $artists = array();
        if($result->num_rows > 0) {
            while($artist = mysqli_fetch_assoc($result)){
                $artists[] = $artist;
            }
        }
        return $artists;
    }

    function __destruct() {
        mysqli_close($this->conn);
    }
}
?>