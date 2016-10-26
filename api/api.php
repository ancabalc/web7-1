<?php

session_start();

require "helpers/functions.php";

$routes = [];
// $routes["/articles"] = array("controller" => "Articles",
//                                 "method" => "index");

if (isset($_SERVER["REDIRECT_URL"])) {
    $key = rtrim($_SERVER['REDIRECT_URL'], '/');
    //$key = $_SERVER["REDIRECT_URL"];
    if (array_key_exists($key, $routes)) {
        require "api/controllers/" . $routes[$key]["controller"] . ".php"; 
        $controller = new $routes[$key]["controller"]();
        $response = $controller->$routes[$key]["method"]();
   
        // Print response for XHR|AJAX JS
        api_response($response, http_response_code());
    }
    else {
        api_response(array("error"=>"Page not found"), 404);
    }
}
else {
    api_response(array("error"=>"Access Forbidden"), 403);
}
