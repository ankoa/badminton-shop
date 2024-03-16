
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
        }
    ?>
    <div class="back-to-top">
        <a class="" href="#"><i class="fa-solid fa-arrow-up back-top-top-icon"></i></a>
    </div>
</div>
