<?php
require_once("../../models/Show.php");
require_once("../../models/Movie.php");
require_once("../../connection/connection.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$response = [];
$response["status"] = 200;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    
    if (isset($input["date"])) {
        $date = $input["date"];
        $showsNum = Show::todayShowsNum($mysqli, $date);
        if ($showsNum) {
            $response["showsNum"] = $showsNum;
            
        } else {
            $response["status"] = 404;
            $response["showsNum"] = "No shows for today";
        }
    }
}
echo json_encode($response);