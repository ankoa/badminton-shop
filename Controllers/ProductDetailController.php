<?php
require_once __DIR__ . '/../Model/ModelProduct.php';
require_once __DIR__ . '/../Model/ModelRacket.php';
require_once __DIR__ . '/../Model/ModelBrand.php';

// Lấy dữ liệu từ Model và truyền cho View để hiển thị
// Ví dụ:
$modelProduct = new ModelProduct();
$productID = 7; // ID sản phẩm
$product = $modelProduct->getProductByID($productID);

$modelRacket = new ModelRacket();
$listRacket = $modelRacket->getListRacketByID($productID);
$racket = $modelRacket->getRacketByIDAndColor($productID, reset($listRacket)->getColor());

$modelBrand = new ModelBrand();
$brand = $modelBrand->getBrandByID($product->getBrandID());

// Gọi View để hiển thị
include_once '../View/user/pages/product_detail.php';
?>
