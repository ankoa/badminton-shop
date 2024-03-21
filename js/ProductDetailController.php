<?php
require_once(__DIR__ . '.Model/ModelVariantDetail.php');
function getVersionByColor($productID, $color) {
    $modelVariant = new ModelVariant();
    $listvariants = $modelVariant->getListVariantByProductID($productID);

    $modelVariantDetail = new ModelVariantDetail();
    $listVariantDetails = [];

    foreach ($listvariants as $variant) {
        $variantID = $variant->getVariantID();
        $variantDetail = $modelVariantDetail->getVariantByID($variantID);
        // Thêm chi tiết biến thể vào mảng $listVariantDetails
        if($variantDetail->getColor() == $color) {
            $listVariantDetails[] = $variantDetail;
        }
    }
}

// Kiểm tra nếu có dữ liệu được gửi từ yêu cầu AJAX
if (isset($_GET['productID']) && isset($_GET['color'])) {
    // Lấy dữ liệu từ yêu cầu AJAX
    $productID = $_GET['productID'];
    $color = $_GET['color'];

    // Gọi hàm để lấy dữ liệu từ cơ sở dữ liệu
    $listVariantDetails = getVersionByColor($productID, $color);

    // Trả về dữ liệu dưới dạng chuỗi JSON
    echo json_encode($listVariantDetails);
} else {
    // Nếu không có dữ liệu được gửi, trả về một thông báo lỗi
    echo "Error: No data received.";
}
?>
