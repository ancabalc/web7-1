<?php

class Account {
    public function create() {
        
    }
    public function login() {
        echo "salut";
        $errors = array();
        if (isset($_POST["email"])) {
            if (empty($_POST["email"])) {
                $errors["email"] = "Email is required";    
            }
            
            if (empty($errors)) {
                require "api/models/Users.php";
                $usersModel = new UsersModel();
                $user = $usersModel->loginUser($_POST["email"]);
                
                if ($user === FALSE) {
                    $errors["invalid"] = "Invalid credentials";
                }
                else {
                    $_SESSION["isLogged"] = TRUE;
                    $_SESSION["user"] = $user;
                    return $user;
                }
            }
        }
        else {
            $errors["invalid"] = "Request invalid"; 
        }
        
        return array("errors" => $errors);
    }
}