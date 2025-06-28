<?php
header('Content-Type: application/json');
require("../../models/Movie.php");
require("../../connection/connection.php");

$response = [];
$response["status"] = 200;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);

    $required = ['title', 'description', 'cover_image', 'trailer_url', 'rating', 'release_date', 'duration'];
    $data = [];

    foreach ($required as $field) {
        if (!isset($input[$field])) {
            $response['status'] = 400;
            $response['message'] = "Missing required field: " . $field;
            echo json_encode($response);
            return;
        } else {
            $data[$field] = $input[$field];
        }
    }
    // if id is sent then its an update 
    if (isset($input['id'])) {
        $updated = Movie::update($mysqli, $data, $input['id']);
        if ($updated) {
            $response["status"] = 200;
            $response["message"] = "Record Updated!";
        } else {
            $response["status"] = 500;
            $response["message"] = "Failed to update record";
        }
        echo json_encode($response);
        return;
    }

    $created = Movie::create($mysqli, $data);

    if ($created) {
        $response["status"] = 200;
        $response["message"] = "Record Created!";
    } else {
        $response["status"] = 500;
        $response["message"] = "Failed to create record";
    }
    echo json_encode($response);
    return;

}
