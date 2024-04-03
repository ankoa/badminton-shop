<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web dụng cụ thể thao cầu lông</title>
    <link rel="stylesheet" href="../View/css/style.css">
    <link rel="stylesheet" href="../View/css/homepage.css">
    <link rel="stylesheet" href="../View/css/footer.css">
    <link rel="stylesheet" href="../View/css/slider.css">
    <link rel="stylesheet" href="../View/css/signup-menu.css">
    <link rel="stylesheet" href="../View/css/product_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.shopvnb.com/themes/css/bootstrap-4-3-min.css">

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
     <script src="../js/slider.js" defer></script>
     <script src="../js/backToHome-button.js" defer></script>
     <script src="../js/product_detail.js" defer></script>
     



    </body>
</html> 