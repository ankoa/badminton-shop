<div id = "main">
<?php 
    if(isset($_GET['control'])){
        $tmp = $_GET['control'];

    }
    else $tmp = '';
    if($tmp=='ProductCategory'){
        include("main/product_page.php");
    }
    else if($tmp=='SaleOffCategory'){
        include("main/saleOff_page.php");
    }
    else if($tmp=='IntroduceCategory'){
        include("main/intro_page.php");
    }
    else if($tmp=='ContactCategory'){
        include("main/contact_page.php");
    }
    else{
        include("main/home_page.php");
    }
?>
</div>