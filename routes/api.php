<?php

$apis = [
    // request => [controller,method]
    "/register"=> ['controller'=>'AuthController','method'=>'createUser'],
    "/login"=>['controller'=>'AuthController','method'=>'login'],
    "/shows" => ['controller'=>'ShowsController','method'=>'getShows'],
    "/showsNum" =>['controller'=>'ShowsController','method'=>'numShows'],
];