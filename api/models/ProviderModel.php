<?php
require_once "db.php";

class ProviderModel extends DB {
    public function getTopThree(){
        $sql = 'SELECT name,description,email FROM users WHERE role="provider" ORDER BY id DESC LIMIT 3';
        $sth = $this ->dbh -> prepare($sql);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>