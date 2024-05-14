<?php
//  kết nối server
require_once  "../Model/database.php";
require_once "./Badminton_Admin.php";

$ModelProduct = new ModelProduct();

if (isset($_GET['productID'])) {
  // Lấy ID sản phẩm cần xóa
  $ProductID = $_GET['productID'];
  $result = $ModelProduct -> deleteProduct($ProductID);
  if ($result->status == 200) {
    echo "<script>alert('Xoá sản phẩm thành công!')</script>";
    // header("Location: ./Badminton_Admin.php");
} else {
    echo "<script>alert('Không thể xoá sản phẩm:')</script> " . $result->message;
}
  }