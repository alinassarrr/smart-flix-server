<?php
require_once(__DIR__ ."/../connection/connection.php");
require_once(__DIR__ ."/../services/ResponseService.php");

class BaseController{
    protected $mysqli;
    public function __construct(mysqli $mysqli){
        $this->mysqli=$mysqli;
    }
    public static function success_response($data){
        echo ResponseService::success_response($data);
    }
    public static function error_response($message){
        echo ResponseService::error_response($message);
    }
}