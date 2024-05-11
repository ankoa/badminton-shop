<?php
require_once '../Model/ModelProduct.php'; 
$modelProduct = new ModelProduct();
$products = $modelProduct->getAllProducts();
$productInfo = [];
foreach ($products as $product) {
    $productInfo[] = [
        'productID' => $product->getProductID(),
        'name' => $product->getName(),
        'price' => $product->getPrice()

    ];
}

echo json_encode($productInfo);
?>
