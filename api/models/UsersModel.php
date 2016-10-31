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
    
    function loginUser($email) {
        
        $params = [':email' => $email];

        $sql = 'SELECT email,password FROM users WHERE email = :email';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
       
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    function listUsers() {
        
        $sql = "SELECT name, description, image FROM users where ROWNUM <= 3";
        $sth = $this ->dbh -> prepare($sql);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
      }
}

