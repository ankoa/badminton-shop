<?php
//  kết nối server
require_once __DIR__ . "./Connect.php";
require_once __DIR__ . "./Badminton_Admin.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Lấy dữ liệu từ form
  $productName = $_POST['productName'];
  $productPrice = $_POST['productPrice'];
  $productBrand = $_POST['productBrand'];
  $productType = $_POST['productType'];
  $productWeight = $_POST['productWeight'];
  $productSize = $_POST['productSize'];
  $productMaterial = $_POST['productMaterial'];
  $productImage = $_POST['productImage'];

  // Viết truy vấn SQL
  $sql = "INSERT INTO `products` ( `productName`, `productPrice`, `productBrand`, `productType`, `productWeight`, `productSize`, `productMaterial`, `productImage`) 
VALUES ( '$productName', $productPrice, '$productBrand', '$productType', '$productWeight', '$productSize', '$productMaterial', '$productImage')";

  if ($conn->query($sql) === TRUE) {
    echo "Thêm sản phẩm thành công!";
    header("Location : Badminton_Admin.php");
  } 
  // else {
  //   echo "Lỗi: <br>" . $sql . "<br>" . $conn->error;
  // }
}

// Đóng kết nối
$conn->close();
