<?php 
    session_start();
    require_once(__DIR__ . '/../Model/ModelUser.php');
    if(isset($_POST['username']) && isset($_POST['password'])){
        $modeluser = new ModelUser();
        $username= $_POST['username'];
        $password= $_POST['password'];
        $t = $modeluser->authenticate($username, $password);
        print_r($t);
        if($modeluser->authenticate($username, $password) != false){ 
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        }
        else {
            $error_message = "Tên người dùng hoặc mật khẩu không chính xác!";
           
        }
    }
?>
