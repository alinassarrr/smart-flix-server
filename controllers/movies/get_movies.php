<?php
require("../../models/Movie.php");
require("../../connection/connection.php");

$response = [];
$response["status"] = 200;

if (!isset($_GET["id"])) {
    $movies = Movie::all($mysqli);

    $response["movies"] = [];
    foreach ($movies as $movie) {
        $response["movies"][] = $movie->toArray();
    }
    echo json_encode($response);
    return;
}

$id = $_GET["id"];
$movie = Movie::find($mysqli, $id);
if ($movie) {
    $response["movie"] = $movie->toArray();
} else {
    $response["status"] = 404;
    $response["message"] = "Movie not found!";
}

echo json_encode($response);
return;