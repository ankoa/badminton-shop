<?php 
    session_start();
    require_once(__DIR__ . '/../Model/ModelUser.php');
    require_once(__DIR__ . '/../Model/ModelRole.php');
    require_once(__DIR__ . '/../Model/ModelCartDetail.php');
    require_once(__DIR__ . '/../Model/Entity/CartDetail.php');
    if(isset($_POST['action'])) {
        $modeluser = new ModelUser();
        $modelrole = new ModelRole();
        $modelCartDetail = new ModelCartDetail();
        if($_POST['action'] == 'signin') {
            if(isset($_POST['username']) && isset($_POST['password'])) {     
                $username = $_POST['username'];
                $password = $_POST['password'];
                if(!empty($username) && !empty($password)) {
                    $authenticated_user = $modeluser->authenticate($username, $password);
                    if($authenticated_user){ 
                        $authenticated_role = $modeluser->getRoleUsetByID($modeluser->getUIDByUserName($username));   
                        if($authenticated_role ==1){
                            $_SESSION['login'] = true;
                            $_SESSION['username'] = $username;
                            echo json_encode(array(
                                'message' => "Đăng nhập thành công - khách hàng",
                                'status' => 1
                            ));
                            exit;
                        } elseif($authenticated_role == 2){
                            $_SESSION['login'] = true;
                            $_SESSION['username'] = $username;
                            echo json_encode(array(
                                'message' => "Đăng nhập thành công - nhân viên",
                                'status' => 2
                            ));
                            exit;   
                        }
                        elseif($authenticated_role == 3){
                            $_SESSION['login'] = true;
                            $_SESSION['username'] = $username;
                            echo json_encode(array(
                                'message' => "Đăng nhập thành công - admin",
                                'status' => 2
                            ));
                            exit;   
                        }
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
            if(isset($_POST['formName']) && isset($_POST['formPassword']) && isset($_POST['formPhone']) && isset($_POST['formEmail'])) {
                $username = $_POST['formName'];
                $password = $_POST['formPassword'];
                $phone = $_POST['formPhone'];
                $email = $_POST['formEmail'];
                if(!empty($username) && !empty($password) && !empty($phone) && !empty($email)) {
                    $checkError = false;
                    if($modeluser->checkExistingUsername($username)!=false|| $modeluser->checkExistingEmail($email)!=false || $modeluser->checkPhoneNumberFormat($phone)==false) {
                        $checkError = true;
                    }
                    if(!$checkError){ 
                        
                        $add_user = $modeluser->addUser($username, $password, 2, $username, $email, $phone, 0, 'normal', 1);
                        if ($add_user == 1) {
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
                    }
                }
            }
            
                
            
/*            else{
                echo json_encode(array(
                    'message' => "Lỗi POST data form",
                    'status' => 0
                ));
            } */
        
    }
    }    
    ?>
    
