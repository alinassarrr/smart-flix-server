<?php
header("Content-Type: application/json");
require_once("../../connection/connection.php");
require_once("../../models/User.php");

$response = [];
$response["status"] = 200;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input["email"]) && isset($input["password"])) {
        $email = $input["email"];
        $password = $input["password"];
        $phone = $input["phone"];

        $user = User::findBy($mysqli, "email", $email);
        if ($user) {
            $verified = password_verify($password, $user->getPasswordHash());
            if ($verified) {
                $response["status"] = 200;
                $response["message"] = "Welcome Back " . $user->getUsername();
                echo json_encode($response);
                return;
            } else {
                $response["status"] = 400;
                $response["message"] = "Invalid Credentials";
                echo json_encode($response);
                return;
            }
        } else {
            $response["status"] = 400;
            $response["message"] = "Invalid Email or Password";
            echo json_encode($response);
            return;
        }
    }
}