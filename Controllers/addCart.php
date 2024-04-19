<?php
require_once(__DIR__ . '/../Model/ModelCartDetail.php');
require_once(__DIR__ . '/../Model/ModelUser.php');
require_once(__DIR__ . '/../Model/ModelProduct.php');
require_once(__DIR__ . '/../Model/ModelCatalog.php');
require_once(__DIR__ . '/../Model/Entity/Catalog.php');

$modeluser= new ModelUser();
$modelcartdetail= new ModelCartDetail();
$modelproduct= new ModelProduct();
$modelCatalog = new ModelCatalog();

//$_SESSION['login']

if (isset($_GET['productID']) && isset($_GET['username']) && isset($_GET['variantID']) && isset($_GET['quantity']) && isset($_GET['price'])) {
    // Lấy dữ liệu từ yêu cầu AJAX
    if($modelcartdetail->checkCartDetail($_GET['productID'], $_GET['variantID'])==false) {
        $productID = $_GET['productID'];
        $variantID = $_GET['variantID'];
        $quantity = $_GET['quantity'];
        $price = $_GET['price'];
        $username = $_GET['username'];
        $userID= $modeluser->getUIDByUserName($username);
        $modelcartdetail->addCartDetail($userID, $productID, $variantID, $quantity,$price);
    } else {
        $product=$modelproduct->getProductByID($_GET['productID']);
        $quantity=$_GET['quantity']+$modelcartdetail->getQuantityCartDetail($_GET['productID'], $_GET['variantID']);
        $price= $product->getPrice()*$quantity;
        $modelcartdetail->updateAddCartDetail($modeluser->getUIDByUserName($_GET['username']), $_GET['productID'], $_GET['variantID'], $quantity, $price);
    }
    $catalog = $modelCatalog->getCatalogByID($_GET['productID']);
    echo $catalog->getName();
    
} else {
    // Nếu không có dữ liệu được gửi, trả về một mảng trống dưới dạng chuỗi JSON
    echo json_encode([]);
}


?>
