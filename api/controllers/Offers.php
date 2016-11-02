<?php
require "models/OffersModel.php";

class Offers {
    public function create() {
        
    
    }
    public function listItems() {
        if (isset($_GET["id"])) {
            $offersModel = new OffersModel();
            $response = $offersModel->getOffersApplication($_GET["id"]);
            return $response;
        } 
        

    }
}

?>