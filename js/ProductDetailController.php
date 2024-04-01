<?php
// Kiểm tra xem có dữ liệu được gửi đến không
if ($_GET) {
    // Duyệt qua các phần tử trong $_GET để lọc dữ liệu theo data group là "brand"
    $filteredBrands = array();
    foreach ($_GET as $key => $value) {
        if (strpos($key, 'thuong_hieu') !== false) {
            $filteredBrands[$key] = $value;
        }
    }

    // Chuyển đổi dữ liệu thành chuỗi JSON để trả về cho JavaScript
    $jsonData = json_encode($filteredBrands);

    // In ra kết quả lọc được từ JavaScript
    echo "<div>Kết quả nhận được từ JavaScript (data group 'brand'): $jsonData</div>";
} else {
    // Nếu không có dữ liệu được gửi đến từ JavaScript, trả về thông báo lỗi
    echo "<div>Không có dữ liệu lọc được gửi đến.</div>";
}
?>
