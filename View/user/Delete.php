<?php
//  kết nối server
require_once __DIR__. "./Connect.php";
require_once __DIR__. "./Badminton_Admin.php";


// Lấy ID sản phẩm cần xóa
$productID = $_GET['productID'];

// Viết truy vấn SQL
$sql = "DELETE FROM products WHERE productID='$productID'";

// Thực thi truy vấn
if ($conn->query($sql) === TRUE) {
  echo "Xóa sản phẩm thành công!";
  header("Location : Badminton_Admin.php");
} else{
    echo "Lỗi: " . $conn->error;
  }

  // Đóng kết nối
  $conn->close();
?>