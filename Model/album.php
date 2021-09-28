<?php
require_once("dbconnect.php");
class AlbumModel extends DBConnect
{
    function __construct() {
        $this->connectDB();
    }


    function getAllAlbums() {
        $query = "SELECT title FROM album ORDER BY ReleaseDate DESC LIMIT 20";
        $result = $this->conn->query($query);
        $albums = array();
        if($result->num_rows > 0) {
            while($album = mysqli_fetch_assoc($result)){
                $albums[] = $album;
            }
        }
        return $albums;
    }


    function getAlbumsByKeyword($keyword) {
        $query = "SELECT a.CoverPath, a.Title, a.ReleaseDate, c.Name, count(s.SongID) AS song_count FROM album a LEFT JOIN album_details b ON a.AlbumID = b.AlbumID LEFT JOIN artist c ON a.ArtistID = c.ArtistID LEFT JOIN song s ON s.SongID = b.SongID WHERE a.Title LIKE '%$keyword%' GROUP BY a.AlbumID";
        $result = $this->conn->query($query);
        $albums = array();
        if($result->num_rows > 0) {
            while($album = mysqli_fetch_assoc($result)){
                $albums[] = $album;
            }
        }
        return $albums;
    }


    function __destruct() {
        mysqli_close($this->conn);
    }
}
?>