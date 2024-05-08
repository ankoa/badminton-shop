<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    // Tạo một đối tượng ModelTransaction và gọi các phương thức để lấy dữ liệu
    $modelTransaction = new ModelTransaction();
    $salesData = $modelTransaction->getTotalSalesByBrand($startDate, $endDate);


    // Return the data for both charts as JSON
    echo json_encode($salesData);
}

?>
