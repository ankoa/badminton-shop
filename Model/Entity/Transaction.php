<?php 
class Transaction {
    public $transactionID;
    public $userID;
    public $total;
    public $note;
    public $time;
    public $address;

    public function __construct($transactionID, $userID, $total, $note, $time, $address) {
        $this->transactionID = $transactionID;
        $this->userID = $userID;
        $this->total = $total;
        $this->note = $note;
        $this->time = $time;
        $this->address = $address;
    }

    // Getter và setter cho transactionID
    public function getTransactionID() {
        return $this->transactionID;
    }

    public function setTransactionID($transactionID) {
        $this->transactionID = $transactionID;
    }

    // Getter và setter cho userID
    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
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

    // Getter và setter cho time
    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    // Getter và setter cho address
    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
}

?>

