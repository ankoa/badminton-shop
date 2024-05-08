<?php
//  kết nối server
require_once __DIR__. "./Connect.php";
require_once __DIR__. "./Badminton_Admin.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
 // Lấy dữ liệu từ form
 $productName = $_POST['productName'];
 $productPrice = $_POST['productPrice'];
 $productBrand = $_POST['productBrand'];
 $productType = $_POST['productType'];
 $productWeight = $_POST['productWeight'];      
 $productSize = $_POST['productSize'];
 $productMaterial = $_POST['productMaterial'];
 $productImage = $_POST['productImage'];
 $productID = $_POST['productID'];

 // Viết truy vấn SQL
 $sql = "UPDATE `products`  
 SET `productName`='$productName', 
 `productPrice`=$productPrice, 
 `productBrand`='$productBrand', 
 `productType`='$productType', 
 `productWeight`='$productWeight', 
 `productSize`='$productSize', 
 `productMaterial`='$productMaterial',
 `productImage`='$productImage'
 WHERE `productID`='$productID'";

 // Thực thi truy vấn
 if ($conn->query($sql) === TRUE) {
   echo "Cập nhật sản phẩm thành công!";
   header("Location : Badminton_Admin.php");
 } else {
   echo "Lỗi: " . $conn->error;
 }
}
 // Đóng kết nối
 $conn->close();
?>

