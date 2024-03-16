<?php
require_once 'database.php';
require_once '..\Model\Entity\OrderTransaction.php';
class ModelOrderTransaction {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các giao dịch đơn hàng từ cơ sở dữ liệu
    public function getAllOrderTransactions() {
        $query = "SELECT * FROM `ordertransaction` WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $orderTransactions = [];
            while ($row = $result->fetch_assoc()) {
                $orderTransactions[] = $row;
            }
            return $orderTransactions;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin giao dịch đơn hàng bằng ID đơn hàng
    public function getOrderTransactionByOrderID($orderID) {
        $query = "SELECT * FROM `ordertransaction` WHERE orderID = '$orderID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để thêm một giao dịch đơn hàng mới vào cơ sở dữ liệu
    public function addOrderTransaction($transactionID, $productID, $total, $note, $status) {
        $query = "INSERT INTO `ordertransaction` (transactionID, productID, total, note, status) 
                  VALUES ('$transactionID', '$productID', '$total', '$note', '$status')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin giao dịch đơn hàng trong cơ sở dữ liệu
    public function updateOrderTransaction($orderID, $transactionID, $productID, $total, $note, $status) {
        $query = "UPDATE `ordertransaction` 
                  SET transactionID = '$transactionID', productID = '$productID', total = '$total', 
                      note = '$note', status = '$status' 
                  WHERE orderID = '$orderID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một giao dịch đơn hàng khỏi cơ sở dữ liệu
    public function deleteOrderTransaction($orderID) {
        $query = "UPDATE FROM `ordertransaction` SET status= 0 WHERE orderID = '$orderID'";
        return $this->db->delete($query);
    }
}

?>
