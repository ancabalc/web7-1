<?php

class UsersModel extends DB{
      function listUsers() {
        $sql = "SELECT name, description, image FROM users where ROWNUM <= 3";
        $sth = $this ->dbh -> prepare($sql);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
      }
}
        

