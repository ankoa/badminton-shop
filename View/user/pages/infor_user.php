<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .signin {
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45%; 
            max-width: 35rem; 
            height: 80%;
        }
        .form-input {
            font-family: 'Poppins', sans-serif;
            color: black;
            padding: 1.5rem;
            border-radius: 1rem;
            outline: none;
            font-size: 1.6rem;
            font-weight: 500;
            border: 1px solid #eee; 
            background-color: #eee;
            transition: .25s linear;
            width: 100%;
            height: 10%;
        }
        .form-submit {
            border-radius: 10px;
            color: white;
            outline: none;
            padding: 1.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            text-align: center;
            cursor: pointer;
            border: 0;
            width: 80%;
            background-color: #ed673a;
            margin-top: 0.3rem;
        }
        .signin-heading {
            font-size: 2.5rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <?php
    // Kiểm tra session tồn tại và có chứa thông tin người dùng không
    if (isset($_SESSION['username'])) {
        // Lấy thông tin username từ session
        $username = $_SESSION['username'];
        echo $username;
        // Import file ModelUser nếu cần
        require_once __DIR__ . '/../../../Model/ModelUser.php';

        // Tạo đối tượng ModelUser để thực hiện truy vấn
        $modelUser = new ModelUser();

        // Truy vấn thông tin người dùng từ CSDL
        $user = $modelUser->getUserByUsername($username);

        // Kiểm tra nếu có thông tin người dùng
        if ($user !== null) {
            echo'ok';
            // Gán thông tin từ user vào các trường input trên form
            $name = $user->getName();
            $phoneNumber = $user->getPhoneNumber();
            $email = $user->getMail();
        }
    }
    ?>
    <div id="sigin-background">
        <div class="signin" id="create">
                <a class="signin-icon" onclick="displaySignMenu('none')"><i class="fa-solid fa-x"></i></a>
                <h2 class="signin-heading">THÔNG TIN TÀI KHOẢN</h2>
                <p class="signin-already" id="signin-already"> 
                    <a href="index.php?control=signin" class="signin-link-underline" onclick="fdn()"></a>
                </p>
                <div class="error-signup"> <p class="error-message"></p> </div>
                <form id="infor-form" action="../Controllers/Signin-upController.php" method="post" >
                    <div class="form-user-name">
                        <input type="text" class="form-input" placeholder="Name" id="form-Name" name="formName" value="<?php echo isset($name) ? $name : ''; ?>">
                    </div>
                    <div class="form-password">
                        <input type="password" class="form-input" placeholder="Password" id="form-Password" name="formPassword" value="">
                    </div>
                    <div class="form-phone">
                        <input type="text" class="form-input" placeholder="Phone" id="form-Phone" name="formPhone" value="<?php echo isset($phoneNumber) ? $phoneNumber : ''; ?>">
                    </div>
                    <div class="form-email">
                        <input type="text" class="form-input" placeholder="E-mail" id="form-Email" name="formEmail" value="<?php echo isset($email) ? $email : ''; ?>">
                    </div>
                    <div>
                        <button type="submit" class="form-submit">
                            <span class="form-submit-text">Đăng kí</span>             
                            <i class="fa fa-long-arrow-right form-submit-icon"></i>      
                        </button>
                    </div>
                    <input type="hidden" name="action" value="signup">
                </form>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js" defer></script>
    <script src="../js/signin-up.js" defer></script>
</body>
</html>

    
      
