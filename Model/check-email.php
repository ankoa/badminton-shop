<?php
    require_once(__DIR__ . '/../Model/ModelUser.php');
    $email = $_GET['formEmail'];
    $modeluser = new ModelUser();
    if(!$modeluser->checkExistingEmail($email)){

        echo json_encode(true);
    }else{
        echo json_encode(false);
    
    } 
?>