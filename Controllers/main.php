<div id = "main">
    <?php 

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        } else $id = '';
        if(isset($_GET['control'])){
            $tmp = $_GET['control'];
        }
        else $tmp = 'home_page';
        if($tmp=='ProductCategory'){
            include("../View/user/pages/product_page.php");
        }
        else if($tmp=='SaleOffCategory'){
            include("../View/user/pages/saleOff_page.php");
        }
        else if($tmp=='IntroduceCategory'){
            include("../View/user/pages/intro_page.php");
        }
        else if($tmp=='ContactCategory'){
            include("../View/user/pages/contact_page.php");
        }
        else if($tmp=='checkDonHang'){
            include("../View/user/pages/orderTransaction_page.php");
        }
        else if($tmp=='home_page' && empty($id)){
            include("../View/user/pages/home_page.php");
        }
        else{
            include("../View/user/pages/product_page.php");
        }

        echo '
        <div class="back-to-top" onclick="scrollToTop()">
            <a class="" href="#"><i class="fa-solid fa-arrow-up back-top-top-icon" style="color: #ffffff;"></i></a>
        </div>'
    ?> 
</div>
<?php
/*session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) 
    {
        include("../View/user/pages/signin.php");
        exit;
    }*/

?>

<?php 
        if(isset($_GET['control'])){
            $tmp = $_GET['control'];
        }
        else $tmp = '';
        if($tmp=='signup'){
            include("../View/user/pages/signup.php");
        }
        else if($tmp=='signin'){
            include("../View/user/pages/signin.php");
        }
        else if($tmp=='logout'){

            
            //Neu nguoi dung da dang nhap thanh cong, thi huy bien session
            if (isset($_SESSION['login'])) 
            {echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            echo '<script>window.location.href = "index.php";</script>';
        }
        /*require_once(__DIR__ . '/../Model/ModelUser.php');
        $modeluser = new ModelUser();
        $add_user = $modeluser->addUser(1, 111, 1, 111, "a@gmail.com", "0364985452", 0, 'normal', 1);
        echo $add_user;
        require_once(__DIR__ . '/../Model/check-email.php');*/
    ?>
    