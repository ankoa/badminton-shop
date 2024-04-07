<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web dụng cụ thể thao cầu lông</title>
    <?php
    if(isset($_GET['control'])) {
        if($_GET['control']=="ProductCategory") {
            echo '<link rel="stylesheet" href="../View/css/product_nav.css"> <script src="../js/nav.js" defer></script>';
        } else if($_GET['control']=="ProductDetail") {
            echo '<link rel="stylesheet" href="../View/css/product_detail.css"> <script src="../js/product_detail.js" defer></script>';
        } else if($_GET['control']=="checkDonHang") {
            echo '<link rel="stylesheet" href="../View/css/checktranscation.css"> <script src="../js/Transaction.js"> defer</script>';
        }
    } else {
        echo '<link rel="stylesheet" href="../View/css/slider.css"> <script src="../js/slider.js" defer></script>';
    }
        
    ?>
    <link rel="stylesheet" href="../View/css/style.css">
    <link rel="stylesheet" href="../View/css/homepage.css">
    <link rel="stylesheet" href="../View/css/footer.css">
    
    <link rel="stylesheet" href="../View/css/signup-menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.shopvnb.com/themes/css/danh_muc_style.scss.css?v=16" rel="stylesheet" type="text/css" />
    <link rel="preload" as='style' type="text/css" href="https://cdn.shopvnb.com/themes/css/sidebar_style.scss.css">
    <link href="https://cdn.shopvnb.com/themes/css/sidebar_style.scss.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<header id="header">
<?php include("../View/user/header.php"); ?>
</header>

<body>
    <div class="wrapper">
        
        <?php
            include("../Controllers/main.php");
            include("../View/user/footer.php");
        ?>
    </div>
     <script src="../js/backToHome-button.js" defer></script>
    </body>
</html> 
