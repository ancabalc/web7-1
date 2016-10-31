<?php
    
class Accounts {
    public function create() {
        $errors = array();
        if(isset($_POST["email"])) {
            if (empty($_POST["email"])) {
               $errors["email"] = "Email is required"; 
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Email is invalid";
            }
            $patternPassword = '/^[a-z0-9$#_]{5,15}$/i';
            if (empty($_POST["password"])) {
                $errors["password"] = "Password is required";     
            } elseif (!preg_match($patternPassword, $_POST["password"])) {
                $errors["password"] = "Password is invalid";
            }
            if (empty($_POST["repassword"])) {
                $errors["repassword"] = "Please retype the password";     
            } elseif ($_POST["password"] !== $_POST["repassword"]) {
                $errors["repassword"] = "Not equal with password";    
            }
            if (empty($errors)) {
                $salt = '$1$';
                $_POST["password"] = crypt($_POST["password"], $salt);
                require "models/UsersModel.php";
                $usersModel = new UsersModel();
                $userId = $usersModel->createUser($_POST);
                if($userId) {
                    return json_encode($usersModel->getUserById($userId));
                }
            } else {
                return $errors;
            }
        
        }
    }
    
    public function login() {
        $errors = array();
        if (isset($_POST["email"])) {
            if (empty($_POST["email"])) {
                $errors["email"] = "Email is required";    
            }
            
            if (empty($_POST["password"])) {
                $errors["passsword"] = "Password is required";    
            }
        
            if (empty($errors)) {
                $salt = '1#$2';
                
                require "models/UsersModel.php";
                $usersModel = new UsersModel();
                $user = $usersModel->loginUser($_POST["email"]);
                
                if ($user === FALSE) {
                    $errors["invalid"] = "Invalid credentials";
                }
                else {
                    if($_POST["password"] == crypt($_POST["email"],$salt)) {
                        $_SESSION["isLogged"] = TRUE;
                        $_SESSION["user"] = $user;
                        return $user;
                    }
                    
                }
            }
        }
        else {
            $errors["invalid"] = "Request invalid"; 
        }
        
        return array("errors" => $errors);
        
    }
}