<?php

session_start();

ini_set('display_errors', 1);


require "helpers/functions.php";

$routes = [];
$routes["/api/accounts/login"] = array("controller" => "Accounts",
                                "method" => "login");
$routes["/api/accounts/create"] = array("controller" => "Accounts",
                                "method" => "create");
$routes["/api/users/update"] = array("controller" => "Users",
                                "method" => "updateUser");
$routes["/api/applications"] = array ("controller" => "Applications",
                                    "method" => "getApplications");
$routes["/api/users/listUsers"] = array ("controller" => "Users",
                                    "method" => "listUsers");
                                
$routes["/api/controllers/offers"] = array("controller" => "Offers",
                                "method" => "listItems");
$routes["/api/controllers/provider"] = array("controller" => "Provider",
                                "method" => "prov");

if (isset($_SERVER["REDIRECT_URL"])) {
    $key = rtrim($_SERVER['REDIRECT_URL'], '/');
    if (array_key_exists($key, $routes)) {
        require "controllers/" . $routes[$key]["controller"] . ".php"; 
        $controller = new $routes[$key]["controller"]();
        $response = $controller->$routes[$key]["method"]();
   
        // Print response for XHR|AJAX JS
        api_response($response, http_response_code());
    } else {
        api_response(array("error"=>"Page not found"), 404);
    }
} else {
    api_response(array("error"=>"Access Forbidden"), 403);
}
