<?php
//  kết nối server
require_once "../Model/database.php";
require_once "./Badminton_Admin.php";
$ModelProduct = new ModelProduct();

if($_SERVER['REQUEST_METHOD']=='POST'){
 // Lấy dữ liệu từ form
 $name = $_POST['name'];
 $price = $_POST['price'];
 $discount = $_POST['discount'];
 $description = $_POST['description'];
 $image = $_POST['image'];      

  // Kiểm tra xem dữ liệu có hợp lệ không
  if ($name && $price && $discount && $description && $image) {
    // Tạo nhà cung cấp và xử lý kết quả
    $result = $ModelProduct -> updateProduct($productID, $name, $price, $discount, $status, $description, $image);
    if ($result->status == 200) {
        echo "<script>alert('Cập nhật nhà cung cấp thành công!')</script>";
    } else {
        echo "<script>alert('Không thể cập nhật nhà cung cấp: ')</script>" . $result->message;
    }
} else {
    echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
}
}
