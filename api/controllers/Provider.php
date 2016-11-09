<?php 
require "models/ProviderModel.php";

class Provider {
    function prov() {
        $prov = new ProviderModel();
        return $prov->getTopThree();
    } 
}