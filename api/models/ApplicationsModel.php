<?php
require_once "db.php";

class ApplicationsModel extends DB {
    public function getApplications() {
       $sql = 'SELECT * FROM applications';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
       
        return $sth->fetchAll(PDO::FETCH_ASSOC);  
       
    }
    function getApplicationsById($id) {
        $sql = "select * from applications where id=" . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
?>