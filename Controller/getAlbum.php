<?php
    include('../Model/album.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $albumModel = new AlbumModel();
        $albums = $albumModel->getAllAlbums();
        if($albums) {         
            echo json_encode(array('success' => TRUE, 'albums' => $albums));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>