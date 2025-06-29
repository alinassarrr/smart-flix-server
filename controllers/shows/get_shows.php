<?php
require_once("../../models/Show.php");
require_once("../../models/Movie.php");
require_once("../../connection/connection.php");

$response = [];
$response["status"] = 200;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    
    if (isset($input["date"])) {
        $date = $input["date"];
        $shows = Show::findByDate($mysqli, $date);
        if ($shows) {
            $response["shows"] = [];
            foreach ($shows as $show) {
                $movie = Movie::find($mysqli, $show->getMovieId());
                $response["shows"][] = [
                    "show" => $show->toArray(),
                    "movie" => $movie->toArray()
                ];
            }
        } else {
            $response["status"] = 404;
            $response["shows"] = [];
            $response["message"] = "No shows found for this date.";
        }
    }
}
echo json_encode($response);