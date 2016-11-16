<?php
require_once "db.php";

class ApplicationModel extends DB {
    public function getApplications() {
       $sql = 'SELECT * FROM applications';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
       
        return $sth->fetchAll(PDO::FETCH_ASSOC);  
       
    }
    
    function getUserApplication($userId) {
        $params = [':id' => $userId];
        $sql = 'SELECT * FROM applications WHERE user_id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
       
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    function getApplicationsById($id) {
        $sql = "select * from applications where id=" . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createApplications($item) {
        $params = [':user_id' => $item["user_id"],
                   ':title' => $item["title"],
                   ':description' => $item["description"]];

        $sql = 'INSERT INTO applications (user_id, title, description)
                VALUES (:user_id, :title , :description )';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $this->dbh->lastInsertId();
    }
}

?>
