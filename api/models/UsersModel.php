<?php

require_once "db.php";

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
    
    public function update() {
        
    }
}