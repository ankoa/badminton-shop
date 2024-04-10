<?php
// Import module ModelProduct
require_once 'path/to/ModelProduct.php';

// Khởi tạo đối tượng ModelProduct
$modelProduct = new ModelProduct();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_text'])) {
    $searchText = strtolower($_POST['search_text']);

    // Lấy danh sách sản phẩm từ module ModelProduct
    $products = $modelProduct->getAllProducts();
/* 
    // Tạo mảng chứa kết quả tìm kiếm
    $searchResults = [];
    foreach ($products as $product) {
        $productName = strtolower($product->getName());
        if (strpos($productName, $searchText) !== false && $searchText !== '') {
            $searchResults[] = [
                'name' => $product->getName(),
                'description' => $product->getDescription()
            ];
        }
    }
 */
    // Trả về kết quả dưới dạng JSON
    echo json_encode($products);
}
?>
