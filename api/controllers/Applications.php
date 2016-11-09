<?php
require "models/ApplicationsModel.php";

class Applications {
    public function createApplications () {
        // $response = validate_request();
        // if ($response['error']) return $response;
        
         $errors = array();
        
        if (empty($_POST["title"])) {
            $errors["title"] = "Please insert title";
        } 
        if (empty($_POST["description"])) {
            $errors["description"] = "Please insert description";
        }
        if (empty($_POST["active"])) {
            $errors["active"] = "Active is required";
        }
        if(empty($errors)) {
            $applicationModel = new ApplicationModel();
            $applicationId = $applicationModel-> createApplications($_POST);
            return array("id" => $applicationId);
            
        } else {
            return $errors;
        }

        $_POST[] = "";
        if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        move_uploaded_file($file["tmp_name"], "../uploads/".$file["name"]);
        
        $_POST[] = $file["name"];
         }
        
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
}

