<?php

require_once "../models/db.php";

class Users extends DB {
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
    
    public function update() {
        
    }
    
    public function listUsers () {
        $listUsersModel = new UsersModel();
        $response = $listUsersModel->listUsers();
        return $response;
    }
    
}

      
