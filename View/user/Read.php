<?php
//  kết nối server
require_once __DIR__. "./Connect.php";
require_once __DIR__. "./Badminton_Admin.php";

// Viết truy vấn SQL
$sql = "SELECT * FROM products";

// Thực thi truy vấn
$result = mysqli_query($conn,$sql);

// Lặp qua kết quả và hiển thị dữ liệu
if (mysqli_num_rows($result)) {
  echo "<table>";
  echo "<tr><th>ID</th><th>Tên</th><th>Giá</th><th>Thương hiệu</th><th>Phân loại</th><th>Trọng lượng</th><th>Kích thước</th><th>Chất liệu</th><th>Hình ảnh</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["productID"] . "</td>";
    echo "<td>" . $row["productName"] . "</td>";
    echo "<td>" . $row["productPrice"] . "</td>";
    echo "<td>" . $row["productBrand"] . "</td>";
    echo "<td>" . $row["productType"] . "</td>";
    echo "<td>" . $row["productWeight"] . "</td>";
    echo "<td>" . $row["productSize"] . "</td>";
    echo "<td>" . $row["productMaterial"] . "</td>";
    echo "<td>" . $row["productImage"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  header("Location : Badminton_Admin.php");
} else {
  echo "Không có sản phẩm nào.";
}

// Đóng kết nối
$conn->close();
?>