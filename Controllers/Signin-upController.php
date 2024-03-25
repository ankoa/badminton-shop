<?php 
    session_start();
    require_once(__DIR__ . '/../Model/ModelUser.php');
    
    if(isset($_POST['action'])) {
        $modeluser = new ModelUser();
        if($_POST['action'] == 'signin') {
            if(isset($_POST['username']) && isset($_POST['password'])) {     
                $username = $_POST['username'];
                $password = $_POST['password'];
                if(!empty($username) && !empty($password)) {
                    $authenticated_user = $modeluser->authenticate($username, $password);
            
                    if($authenticated_user !== false){ 
                        $_SESSION['login'] = true;
                        echo json_encode(array(
                            'message' => "Đăng nhập thành công",
                            'status' => 1
                        ));
                        exit;
                    } else {
                        echo json_encode(array(
                            'message' => "Tên người dùng hoặc mật khẩu không chính xác!",
                            'status' => 0
                        ));
                        exit;
                    }
                } 
            }
        } else{
            if(isset($_POST['form-Name']) && isset($_POST['form-Password']) && isset($_POST['form-Phone']) && isset($_POST['form-Email'])) {
                $username = $_POST['form-Name'];
                $password = $_POST['form-Password'];
                $phone = $_POST['form-Phone'];
                $email = $_POST['form-Email'];
                $add_user = $modeluser->addUser('user2',$username, $password, 1, $username, $email, $phone, 0, 'normal', 1);
                
                if ($add_user) {
                    $_SESSION['login'] = true;
                    echo json_encode(array(
                        'message' => "Đăng kí thành công",
                        'status' => 1
                    ));
                    exit;
                } else {
                    echo json_encode(array(
                        'message' => "Có lỗi trong quá trình thêm cơ sở dữ liệu",
                        'status' => 0
                    ));
                    exit;
                }
                echo json_encode(array(
                    'message' => "Đăng kí thành công". $add_user,
                    'status' => 1
                ));
            }
        }
    }
    
    ?>
    
