<?php
    include('../Model/album.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $keyword = $_POST['keyword'];

        $keyword = test_input($keyword);

        $albumModel = new AlbumModel();
        $albums = $albumModel->getAlbumsByKeyword($keyword);
        if($albums) {
            echo json_encode(array('success' => TRUE, 'albums' => $albums));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>