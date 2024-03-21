<div id = "main">
    <?php 

        if(isset($_GET['control'])){
            $tmp = $_GET['control'];
        }
        else $tmp = '';
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
        else{
            include("../View/user/pages/home_page.php");
            include("../View/user/pages/login.php");
        }
    ?>
        <div class="back-to-top" onclick="scrollToTop()">
            <a class="" href="#"><i class="fa-solid fa-arrow-up back-top-top-icon" style="color: #ffffff;"></i></a>
        </div>

</div>
<?php 

        if(isset($_GET['control'])){
            $tmp = $_GET['control'];
        }
        else $tmp = '';
        if($tmp=='login'){
            include("../View/user/pages/login.php");
        }
        else{
            include("../View/user/pages/signin.php");
        }
    ?>