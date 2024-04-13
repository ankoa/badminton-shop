<?php
require_once(__DIR__ . '/../Model/ModelCartDetail.php');
require_once(__DIR__ . '/../Model/ModelUser.php');
$modeluser= new ModelUser();
$modelcartdetail= new ModelCartDetail();
//$_SESSION['login']

if (isset($_GET['productID']) && isset($_GET['username']) && isset($_GET['variantID']) && isset($_GET['quantity']) && isset($_GET['price'])) {
    // Lấy dữ liệu từ yêu cầu AJAX
    
    $productID = $_GET['productID'];
    $variantID = $_GET['variantID'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];
    $username = $_GET['username'];
    $userID= $modeluser->getUIDByUserName($username);
    $modelcartdetail->addCartDetail($userID, $productID, $variantID, $quantity,$price);
    echo json_encode("ok");
} else {
    // Nếu không có dữ liệu được gửi, trả về một mảng trống dưới dạng chuỗi JSON
    echo json_encode([]);
}


?>
