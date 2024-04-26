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
    if($modelcartdetail->checkCartDetail($modeluser->getUIDByUserName($_GET['username']), $_GET['productID'], $_GET['variantID'])==false) {
        $productID = $_GET['productID'];
        $variantID = $_GET['variantID'];
        $quantity = $_GET['quantity'];
        $price = $_GET['price'];
        $username = $_GET['username'];
        $userID= $modeluser->getUIDByUserName($username);
        $modelcartdetail->addCartDetail($userID, $productID, $variantID, $quantity,$price);
        echo "k trung";
    } else {
        $product=$modelproduct->getProductByID($_GET['productID']);
        $quantity=$_GET['quantity']+$modelcartdetail->getQuantityCartDetail($_GET['productID'], $_GET['variantID']);
        $price= $product->getPrice()*$quantity;
        $modelcartdetail->updateAddCartDetail($modeluser->getUIDByUserName($_GET['username']), $_GET['productID'], $_GET['variantID'], $quantity, $price);
        echo 'trung';
    }
    $catalog = $modelCatalog->getCatalogByID($_GET['productID']);
    
    
} else if (isset($_GET['productID']) && isset($_GET['cartID']) && isset($_GET['variantID'])) {
    $modelcartdetail->deleteProductCartDetail($_GET['cartID'], $_GET['productID'], $_GET['variantID']);
} else {
    echo json_encode([]);
}


?>
