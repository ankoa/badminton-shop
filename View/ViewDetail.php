<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';
require_once __DIR__ . '../../Model/ModelProduct.php'; // Assuming you have a ModelProduct class

if (isset($_GET['transactionID'])) {
    $transactionID = $_GET['transactionID'];
    $modelTransaction = new ModelTransaction();
    $modelProduct = new ModelProduct(); // Assuming you have a ModelProduct class
    $transactionDetails = $modelTransaction->displayTransactionDetails($transactionID);

    if ($transactionDetails) {
        echo "<h2>Chi tiết hóa đơn cho giao dịch có ID $transactionID:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Product Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>";
        foreach ($transactionDetails as $detail) {
            $product = $modelProduct->getProductByID($detail['productID']); // Assuming you have a getProduct method in ModelProduct class
            $price = $product->getPrice(); // Use getter method for price
            $subtotal = $detail['quantity'] * $price; // Calculate subtotal
            echo "<tr><td>" . $product->name . "</td><td>" . $detail['quantity'] . "</td><td>" . $price . "</td><td>" . $subtotal . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có chi tiết nào cho giao dịch có ID $transactionID";
    }
}
?>
