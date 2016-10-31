<?php
require_once "db.php";

class UsersModel extends DB {
    function updateUser($data) {
        $params = [':id' => $data["id"],
                    ':name' => $data["name"],
                    ':email' => $data["email"],
                    ':password' => $data["password"],
                    ':role' => $data["role"],
                    ':description' => $data["description"],
                    ':image' => $data["image"]];
        
        $sql = 'UPDATE users
                SET name=:name, email=:email, password=:password, role=:role, description=:description, image=:image
                WHERE id=:id';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->rowCount(); 
    }
    
    function loginUser($email) {
        
        $params = [':email' => $email];

        $sql = 'SELECT email,password FROM users WHERE email = :email';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
       
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}