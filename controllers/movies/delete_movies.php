<?php
header("Content-Type: application/json");
require_once("../../connection/connection.php");
require_once("../../models/Movie.php");

$response = [];
$response["status"] = 200;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input["id"])) {
        $id = (int) $input['id'];

        $deleted = Movie::delete($mysqli, $id);
        if ($deleted) {
            $response['status'] = 200;
            $response['message'] = 'Record deleted successfuly';
        } else {
            $response['status'] = 404;
            $response['message'] = 'Movie not found';
        }
        echo json_encode($response);
        return;
    }
    $response['status'] = 400;
    $response['message'] = 'Bad Request';

}