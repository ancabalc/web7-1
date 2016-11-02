<?php

class ApplicationsModel {
    public function createApplications($item) {

        $params = [':title' => $item["title"],
                   ':description' => $item["description"]];

        $sql = 'INSERT INTO applications (title, description ) 
                VALUES(:title , :description, 1)';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $this->dbh->lastInsertId();
    }
}



