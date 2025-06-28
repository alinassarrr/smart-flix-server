<?php

header("Content-Type: application/json");
require_once("../../connection/connection.php");
require_once("../../models/User.php");

$response = [];
$response['status'] = 200;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input["email"])) {
        $email = trim($input["email"]);
        $user = User::findBy($mysqli, "email", $email);
        if ($user) {
            //already Exist
            $response['message'] = 'Email already exist';
            $response["status"] = 400;
            echo json_encode($response);
            return;
        }
        $userPhone = User::findBy($mysqli, "phone", trim($input["phone"]));
        if ($userPhone) {
            $response["message"] = "Phone Number already exists";
            $response["status"] = 400;
            echo json_encode($response);
            return;
        }
        // create one
        $hashed_password = password_hash($input["password"], PASSWORD_DEFAULT);
        $data = [
            "username" => $input['username'],
            "email" => $input["email"],
            "password_hash" => $hashed_password,
            "phone" => $input["phone"],
            "is_admin" => 0,
            "age" => $input["age"],
        ];
        $userCreated = User::create($mysqli, $data);
        if ($userCreated) {
            $response["message"] = "Account Created Successfully";
            $response["status"] = 200;
        } else {
            $response["message"] = "Failed to create your account";
            $response["status"] = 500;
        }

        echo json_encode($response);
        return;
    }
}


