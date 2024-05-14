<?php 
class Transaction {
    public $transactionID;
    public $userID;
    public $total;
    public $note;
    public $time;
    public $address;
    public $check; // Renamed from 'check' for consistency
    public $transport;
    public $status;
    public $nameReceiver; // Camel case for consistency with other properties
    public $phoneReceiver; // Camel case for consistency with other properties

    public function __construct($transactionID, $userID, $total, $note, $time, $address, $check, $transport, $status, $nameReceiver, $phoneReceiver) {
        $this->transactionID = $transactionID;
        $this->userID = $userID;
        $this->total = $total;
        $this->note = $note;
        $this->time = $time;
        $this->address = $address;
        $this->check = $check;
        $this->transport = $transport;
        $this->status = $status;
        $this->nameReceiver = $nameReceiver;
        $this->phoneReceiver = $phoneReceiver;
    }

    // Getter and setter for transactionID
    public function getTransactionID() {
        return $this->transactionID;
    }

    public function setTransactionID($transactionID) {
        $this->transactionID = $transactionID;
    }

    // Getter and setter for userID
    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    // Getter and setter for total
    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    // Getter and setter for note
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    // Getter and setter for time
    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    // Getter and setter for address
    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    // Getter and setter for pay
    public function getCheck() {
        return $this->check;
    }
    
    public function setCheck($check) {
        $this->check = $check;
    }

    // Getter and setter for transport
    public function getTransport() {
        return $this->transport;
    }
    
    public function setTransport($transport) {
        $this->transport = $transport;
    }

    // Getter and setter for status
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }

    // Getter and setter for nameReceiver
    public function getNameReceiver() {
        return $this->nameReceiver;
    }
    
    public function setNameReceiver($nameReceiver) {
        $this->nameReceiver = $nameReceiver;
    }

    // Getter and setter for phoneReceiver
    public function getPhoneReceiver() {
        return $this->phoneReceiver;
    }
    
    public function setPhoneReceiver($phoneReceiver) {
        $this->phoneReceiver = $phoneReceiver;
    }
}
?>
