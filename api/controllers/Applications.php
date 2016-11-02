<?php
require "models/ApplicationsModel.php";

class Applications {
    public function createApplications () {
        $response = validate_request();
        if ($response['error']) return $response;
     
        $_POST[] = "";
        if (isset($_FILES["file"])) {
            $file = $_FILES["file"];
            move_uploaded_file($file["tmp_name"], "../uploads/".$file["name"]);
        
            $_POST[] = $file["name"];
        }
         if (isset($_POST["title"])) {
            $applicationsModel = new ApplicationsModel();
            $id = $applicationsModel->create($_POST);
            return array("id" => $id);
            
        }}
    }
    function validateApplications() {
        $appTitle = mysql_query("SELECT title FROM applications WHERE id = 1");
        $result = mysql_fetch_array($appTitle);
        
        $appDescription = mysql_query("SELECT description FROM applications WHERE id = 1");
        $result = mysql_fetch_array($appDescription);
        
        echo $result['appTitle'];
        echo $result['appDescription'];
    }
    
    function getApplications() {
        $applicationsModel = new ApplicationsModel();
        return $applicationsModel -> getApplications();
    }
