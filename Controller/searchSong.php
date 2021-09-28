<?php
    include('../Model/song.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $keyword = $_POST['keyword'];

        $keyword = test_input($keyword);

        $songModel = new SongModel();
        $songs = $songModel->getsongsByKeyword($keyword);
        if($songs) {
            echo json_encode(array('success' => TRUE, 'songs' => $songs));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>