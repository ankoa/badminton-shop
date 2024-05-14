<?php
    require_once '..\Model\ModelTransaction.php';
    
    class TransactionController {
        private $modelTransaction;

        public function __construct()
        {
            $this->modelTransaction = new ModelTransaction();
        }

        public function getAllTransactions() {
            echo json_encode($this->modelTransaction->getAllTransactions());
        }

        public function getTransactionByID($TransactionID){
            echo json_encode($this->modelTransaction->getTransactionByID($TransactionID));
        }

        public function deleteHoaDon($id) {
            echo json_encode($this->modelTransaction->deleteHoaDon($id));
        }

        public function getTransaction($id) {
            echo json_encode($this->modelTransaction->getTransaction($id));
        }

        public function getTransactionByCustomer($ma_kh, $search) {
            echo json_encode($this->modelTransaction->getTransactionByCustomer($ma_kh, $search));
        }

        public function getAllTransactionByCustomer($ma_kh) {
            echo json_encode($this->modelTransaction->getAllTransactionByCustomer($ma_kh));
        }

        public function getTransactionByPhone($phoneNumber){
            echo json_encode($this->modelTransaction->getTransactionByPhone($phoneNumber));
        }

    }

    $transactionctl = new TransactionController();
    // $action = $_POST['action'];
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action) {
        case 'get-all':
            $transactionctl->getAllTransactions();
            break;
        case 'findPhone':
            $phoneNumber = $_POST['phoneNumber'];
            $transactionctl->getTransactionByPhone($phoneNumber);
            break;
        case 'findTranCode':
            $TransactionID = $_POST['TransactionID'];
            $transactionctl->getTransactionByID($TransactionID);
            break;    
        case 'get':
            $id = $_POST['id'];
            $transactionctl->getTransaction($id);
            break;
        case 'get-customer-order':
            $ma_kh = $_GET['ma_kh'];
            $search = $_GET['search'];
            $transactionctl->getTransactionByCustomer($ma_kh, $search);
            break;
        case 'get-all-customer-order':
            $ma_kh = $_GET['ma_kh'];
            $transactionctl->getAllTransactionByCustomer($ma_kh);
            break;
        case 'delete':
            $id = $_POST['id'];
            $transactionctl->deleteHoaDon($id);
        default:
            break;
        }
?>
