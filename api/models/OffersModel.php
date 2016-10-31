<?php
require_once "db.php";

class OffersModel extends DB {
    function addOffer($item) {
         $params = [':user_id' => $item["user_id"],
                    ':title' => $item["title"],
                    ':description' => $item["description"]];

        $sql = 'INSERT INTO comments(user_id, description, title) 
                VALUES(:user_id , :description, :title)';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
       
        return $this->dbh->lastInsertId();
    
    }
    
}

       