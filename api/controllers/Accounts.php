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
            $patternPassword = '/^[a-z0-9$#_\.]{5,15}$/i';
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
            if (isset($_FILES["image"]) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                $file = $_FILES["image"];
                move_uploaded_file($file["tmp_name"], "../uploads/".$file["name"]); 
                $_POST["image"] = $file['name'];
                
            }
            if (empty($errors)) {
                $salt = '$1$';
                $_POST["password"] = crypt($_POST["password"], $salt);
                require "models/UsersModel.php";
                $usersModel = new UsersModel();
                $userId = $usersModel->createUser($_POST);
                if($userId) {
                    return $usersModel->getUserById($userId);
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
                require "models/UsersModel.php";
                $usersModel = new UsersModel();
                $user = $usersModel->loginUser($_POST["email"]);
                
                if ($user === FALSE) {
                    $errors["invalid"] = "Invalid credentials";
                }
                else {
                    if(crypt($_POST["password"],$user['password']) == $user["password"]) {
                        $_SESSION["isLogged"] = TRUE;
                        $_SESSION["user"] = $user;
                        return $user;
                    }
                    else {
                        $errors["password"] = "Invalid Password";
                    }
                    
                }
            }
        }
        else {
            $errors["invalid"] = "Request invalid"; 
        }
        
        return array("errors" => $errors);
        
    }
    
    function checkSession() {
        if (isset($_SESSION["isLogged"]) && ($_SESSION["isLogged"] == TRUE)) {
            return array("logged"=>TRUE, "user" => $_SESSION["user"]);    
        } 
        else {
            return array("logged"=>FALSE);  
        }
    }
    
    function logout() {
        unset($_SESSION["isLogged"]);
         unset($_SESSION["user"]);
        session_destroy();
         
        return array("success"=>TRUE);
    }
    
    function getUserProfile() {
        $_SESSION["isLogged"] = true;
        $_SESSION["user"] = array('id'=>1);
            validate_request();
            require "models/UsersModel.php";
            $usersModel = new UsersModel();
            return array("logged"=>TRUE, "user" => $usersModel->getUsersById($_SESSION["user"]['id']));   
    }
}