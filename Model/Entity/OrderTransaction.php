<?php

require_once 'Database.php';

class OrderTransaction {
    public $orderID;
    public $transactionID;
    public $productID;
    public $total;
    public $note;
    public $status;

    public function __construct($orderID, $transactionID, $productID, $total, $note, $status) {
        $this->orderID = $orderID;
        $this->transactionID = $transactionID;
        $this->productID = $productID;
        $this->total = $total;
        $this->note = $note;
        $this->status = $status;
    }

    // Getter và setter cho orderID
    public function getOrderID() {
        return $this->orderID;
    }

    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    // Getter và setter cho transactionID
    public function getTransactionID() {
        return $this->transactionID;
    }

    public function setTransactionID($transactionID) {
        $this->transactionID = $transactionID;
    }

    // Getter và setter cho productID
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    // Getter và setter cho total
    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    // Getter và setter cho note
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    // Getter và setter cho status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>
