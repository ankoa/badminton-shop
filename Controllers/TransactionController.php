<?php
    require_once '..\Model\ModelTransaction.php';
    
    class TransactionController {
        private $modelTransaction;

        public function __construct()
        {
            $this->modelTransaction = new ModelTransaction();
        }

        public function getTransactionByID($TransactionID){
            echo json_encode($this->modelTransaction->getTransactionByID($TransactionID));
        }

        public function getTransactionByPhone($phoneNumber){
            echo json_encode($this->modelTransaction->getTransactionByPhone($phoneNumber));
        }

    }

    $order = new TransactionController();
    $action = $_POST['action'];

    switch ($action) {
        case 'findPhone':
            $phoneNumber = $_POST['phoneNumber'];
            $order->getTransactionByPhone($phoneNumber);
            break;
        case 'findTranCode':
            $TransactionID = $_POST['TransactionID'];
            $order->getTransactionByID($TransactionID);
            break;    
        default:
            break;
        }
?>
