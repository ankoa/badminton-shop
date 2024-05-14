<?php
session_start();
require_once 'database.php';
require_once __DIR__ . '/../../../Model/ModelUser.php';
require_once __DIR__ . '/../../../Model/ModelTransaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelUser = new ModelUser();
    $modelTransaction = new ModelTransaction();
    
    $userID = $modelUser->getUIDByUserName($_SESSION['username']);
    $total = $_POST['total'];
    $note = $_POST['note'];
    $time = date('Y-m-d H:i:s');
    $address = $_POST['address'];
    $name_receiver = $_POST['fullname'];
    $phone_receiver = $_POST['phone'];
    $transport = '';
    $status = 1; 
    $check = 'Chưa xác nhận'; 

    $modelTransaction->addTransaction($userID, $total, $note, $time, $address, $name_receiver, $phone_receiver, $transport, $status, $check);
}
?>
