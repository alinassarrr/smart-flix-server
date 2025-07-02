<?php
require_once("../../models/Show.php");
require_once("../../models/Movie.php");
require_once("../../connection/connection.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once("../../models/Auditorium.php");
require_once("../../models/Category.php");

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
                $auditorium = Auditorium::find($mysqli, $show->getauditoriumId());
                $categories = Category::getMovieCategory($mysqli, $show->getMovieId());
                $response["shows"][] = [
                    "show" => $show->toArray(),
                    "movie" => $movie->toArray(),
                    "auditorium" =>$auditorium->toArray(),
                    "categories"=>$categories,
                    
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