<?php
    include('../Model/genre.php');
    include('helpers.php');
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $genreModel = new GenreModel();
        $genres = $genreModel->getAllgenres();
        if($genres) {         
            echo json_encode(array('success' => TRUE, 'genres' => $genres));
        }
        else {
            echo json_encode(array('success' => FALSE));
        }
    }
?>