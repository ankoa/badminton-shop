<?php 
    require_once 'Database.php';

    class ModelTransaction {
        protected $db;
    
        public function __construct() {
            $this->db = new Database();
        }
    
        // Phương thức để lấy tất cả các giao dịch từ cơ sở dữ liệu
        public function getAllTransactions() {
            $query = "SELECT * FROM `transaction`";
            $result = $this->db->select($query);
            if ($result) {
                $transactions = [];
                while ($row = $result->fetch_assoc()) {
                    $transactions[] = $row;
                }
                return $transactions;
            } else {
                return false;
            }
        }
    
        // Phương thức để lấy thông tin của một giao dịch bằng ID
        public function getTransactionByID($transactionID) {
            $query = "SELECT * FROM `transaction` WHERE `transactionID` = '$transactionID'";
            $result = $this->db->select($query);
            if ($result) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        }
    
        // Phương thức để thêm một giao dịch mới vào cơ sở dữ liệu
        public function addTransaction($userID, $total, $note, $time, $address) {
            $query = "INSERT INTO `transaction` (`userID`, `total`, `note`, `time`, `address`) 
                      VALUES ('$userID', '$total', '$note', '$time', '$address')";
            return $this->db->insert($query);
        }
    
        // Phương thức để cập nhật thông tin của một giao dịch trong cơ sở dữ liệu
        public function updateTransaction($transactionID, $userID, $total, $note, $time, $address) {
            $query = "UPDATE `transaction` 
                      SET `userID` = '$userID', `total` = '$total', `note` = '$note', `time` = '$time', `address` = '$address' 
                      WHERE `transactionID` = '$transactionID'";
            return $this->db->update($query);
        }
    
        // Phương thức để xóa một giao dịch khỏi cơ sở dữ liệu
        public function deleteTransaction($transactionID) {
            $query = "DELETE FROM `transaction` WHERE `transactionID` = '$transactionID'";
            return $this->db->delete($query);
        }
    }
    

?>
