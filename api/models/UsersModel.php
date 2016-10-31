<?php
<<<<<<< HEAD:api/models/UsersModel.php

require_once "db.php";
=======
require "api/models/UsersModel.php";
require_once "../models/db.php";
>>>>>>> 5f20ec863127646acf58aa6717e519e6e69e6eb7:api/controllers/Users.php

class UsersModel extends DB {
    public function createUser($user) {
        $params = [':name' => $user["name"],
                   ':email' => $user["email"],
                   ':password' => $user["password"],
                   ':role' => $user["role"]];
                   
        $sql = 'INSERT INTO users(name, email, password, role) VALUES(:name, :email, :password, :role)';
        $sth = $this->dbh->prepare();
        $sth->execute($params);
        
        return $this->dbh->lastInsertId();
    }
    
    public function updateUser() {
        if (isset($_POST["id"])) {
            if (isset($_POST["email"]) || isset($_POST["password"])) {
                $usersModel = new UsersModel();
                $user = $usersModel->updateUser($_POST);
                if ($user) {
                    $response = array("success"=>TRUE);  
                }
                else {
                   $response = array("error"=>"error");        
                }
                return $response;
            } 
        }
    }
}