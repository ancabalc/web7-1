<?php

require "models/UsersModel.php";

class Users extends DB {
    public function updateUser() {
        $errors = array();
        if (isset($_POST["name"])) {
            if (empty($_POST["name"])) {
                $errors["name"] = "Name is required";
            }
            
            if (empty($_POST["description"])) {
                $errors["description"] = "Description is required";
            }
            
            if (empty($_FILES["file"])) {
                $file = $_FILES["file"];
            }
        }
        
        if (empty($errors)) {
            require "models/UsersModel.php";
                
            $usersModel = new UsersModel();
            $user = $usersModel->updateUser($_POST);
            if ($user) {
                $response = array("success"=>TRUE);
                move_uploaded_file($file["tmp_name"], "../uploads/".$file["name"]);
            }
            else {
               $response = array("error"=>"error");        
            }
            return $response;
        }
        else {
            $errors["invalid"] = "Request invalid";
        }
        
        return array("errors" => $errors);
    }
    
      public function listUsers () {
        $limit = empty($_GET['items']) ? 0 : $_GET['items'];
        $listUsersModel = new UsersModel();
        $response = $listUsersModel->listUsers($limit);
        return $response;
      }
    
}

      
