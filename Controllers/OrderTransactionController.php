<?php
    require_once '..\Model\ModelOrderTransaction.php';

    class OrderTransactionController {
        private $modelOrderTransaction;

        public function __construct()
        {
            $this->modelOrderTransaction = new ModelOrderTransaction();
        }
        
        public function getAllOrderTransactions() {
            echo json_encode($this->modelOrderTransaction->getAllOrderTransactions());
        }
    
        public function getOrderTransactionByOrderID($orderID) {
            echo json_encode($this->modelOrderTransaction->getOrderTransactionByOrderID($orderID));
        }
    }

    $CTHD = new ModelOrderTransaction();
    // $action = $_POST['action'];
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action){
        // case 'getcthd':
        //     $ma_hd = $_POST['ma_hd'];
        //     $CTHD->getAllOrderTransactions($ma_hd);
        //     break;
        case 'get-cthd':
            $ma_hd = $_POST['id_transaction'];
            echo json_encode($CTHD->getOrderTransactionByOrderID($ma_hd));
            break;
        // case 'add':
        //     $obj = json_decode(json_encode($_POST['cthd']));

        //     $ctHDctl->addCTHD($obj->{'maHD'}, $obj->{'maCTSP'}, $obj->{'soLuong'}, $obj->{'giaSP'});
        default:
            break;
    }
?>