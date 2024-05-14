<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    
    // Create an instance of ModelTransaction and fetch the sales data
    $modelTransaction = new ModelTransaction();
    $salesData = $modelTransaction->getTotalSalesByBrand($startDate, $endDate);

    // Log the sales data to verify its structure
    error_log("Sales Data returned from model: " . print_r($salesData, true));

    echo json_encode($salesData);
}
?>