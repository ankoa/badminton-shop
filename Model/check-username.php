<?php
    require_once(__DIR__ . '/../Model/ModelUser.php');
    $username = $_GET['formName'];
    $modeluser = new ModelUser();
    if(!$modeluser->checkExistingUsername($username)){

        echo json_encode(true);
    }else{
        echo json_encode(false);
    
    } 
?>