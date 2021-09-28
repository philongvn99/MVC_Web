<?php
    include('../Model/artist.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $artistModel = new ArtistModel();
        $artists = $artistModel->getAllartists();
        if($artists) {         
            echo json_encode(array('success' => TRUE, 'artists' => $artists));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>