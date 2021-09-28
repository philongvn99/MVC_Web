<?php
    include('../Model/artist.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $keyword = $_POST['keyword'];

        $keyword = test_input($keyword);

        $artistModel = new ArtistModel();
        $artists = $artistModel->getArtistsByKeyword($keyword);
        if($artists) {
            echo json_encode(array('success' => TRUE, 'artists' => $artists));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>