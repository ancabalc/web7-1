<?php
require_once "db.php";
class OffersModel extends DB {
    function addOffer($item) {
        
    } 
    function getOffersApplication() {
        $sql = 'SELECT * FROM offers ';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
       
        return $sth->fetchAll(PDO::FETCH_ASSOC);   
    }
   function getOffersById($id) {
        $sql = "select * from offers where id=" . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

}
?>