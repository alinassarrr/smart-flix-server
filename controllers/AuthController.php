<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once(__DIR__ ."/../connection/connection.php");
require_once(__DIR__ ."/../models/User.php");
require_once(__DIR__ ."/BaseController.php");

class AuthController extends BaseController {
    public function createUser(){
        try{
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $input = json_decode(file_get_contents("php://input"), true);
            if (isset($input["email"])) {
                $email = trim($input["email"]);
                $user = User::findBy($this->mysqli, "email", $email);
                if ($user) {
                    //already Exist
                     BaseController::error_response("User Already Exists");
                    return;
                }
                $userPhone = User::findBy($this->mysqli, "phone", trim($input["phone"]));
                if ($userPhone) {
                    BaseController::error_response("Phone Number Already Used");
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
                $userCreated = User::create($this->mysqli, $data);
                if ($userCreated) {
                    BaseController::success_response("User Created Successfuly");
                    return;
                } else {
                    BaseController::error_response("Failed to create your account");
                    return;
                }
            }
            }
        }
        catch(Exception $e) {
            BaseController::error_response($e->getMessage());
        }
            }

    public function login(){
        try{
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $input = json_decode(file_get_contents("php://input"), true);
            if (isset($input["email"]) && isset($input["password"])) {
                $email = $input["email"];
                $password = $input["password"];

                $user = User::findBy($this->mysqli, "email", $email);
                if ($user) {
                    $verified = password_verify($password, $user->getPasswordHash());
                    if ($verified) {
                       BaseController::success_response($user->getId());
                        return;
                    } else {
                        BaseController::error_response("Invalid Credentials");
                    return;
                    }
                } else {
                     BaseController::error_response("Invalid Email or Password");
                    return;
                }
            }
                        }
                    }
                    catch(Exception $e) {
                        BaseController::error_response($e->getMessage());
                    }
                }

            }