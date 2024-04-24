<?php
class DetailTransaction {
    public $detailID;
    public $transactionID;
    public $productID;
    public $quantity;
    public $subtotal;

    public function __construct($detailID, $transactionID, $productID, $quantity, $subtotal) {
        $this->detailID = $detailID;
        $this->transactionID = $transactionID;
        $this->productID = $productID;
        $this->quantity = $quantity;
        $this->subtotal = $subtotal;
    }

    // Getter and setter for detailID
    public function getDetailID() {
        return $this->detailID;
    }

    public function setDetailID($detailID) {
        $this->detailID = $detailID;
    }

    // Getter and setter for transactionID
    public function getTransactionID() {
        return $this->transactionID;
    }

    public function setTransactionID($transactionID) {
        $this->transactionID = $transactionID;
    }

    // Getter and setter for productID
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    // Getter and setter for quantity
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // Getter and setter for subtotal
    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }
}
?>
