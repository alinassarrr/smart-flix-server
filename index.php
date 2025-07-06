<?php 
// Include database connection
require_once ("connection/connection.php");
// Include API routes
require_once ("routes/api.php");

// Extract route name from URL
$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']),'/');
$request = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

//remove base dir from request
if(strpos($request,$base_dir)===0){
    $request = substr($request,strlen($base_dir));
}

//ensure the req is atleast /
if($request == ''){
    $request = '/';
}

// this is for removing the base dir from URL
// smartflix/smart-flix-server/index.php => /
// get req : smart-flix-server/getShows => req = getShows will be request to route to the controller method

// ROUTING 
if(isset($apis[$request])){
    $controller_name = $apis[$request]['controller'];
    $method = $apis[$request]['method'];
    require_once "controllers/{$controller_name}.php";

    $controller = new $controller_name($mysqli); //instantiate the controller and pass mysqli
    if(method_exists($controller, $method)){ // search in controller for method
        $controller->$method(); // execute method if found
    }
    else {
        echo "ERROR: Method {$method} not found for {$controller_name}";
    }
}
else {
    echo "404 Page Not Found !";
}

