<?php 
require_once 'database.php';
require_once '..\Model\Entity\Transaction.php';
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
        public function getTransactionByID($TransactionID) {
            ///$query = "SELECT * FROM transaction WHERE transaction.transactionID = '$transactionID'";
            $query = "SELECT * FROM transaction JOIN ordertransaction ON transaction.transactionID = ordertransaction.transactionID 
                        WHERE ordertransaction.transactionID = '$TransactionID'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                // Initialize an array to store transactions
                $transactions = array();
                
                // Loop through the result set and fetch each row
                while ($row = $result->fetch_assoc()) {
                    // Add each transaction to the transactions array
                    $transactions[] = $row;
                }
                
                // Return the array of transactions
                return $transactions;
            } else {
                // Return false if no transactions found
                return false;
            }
        }

        public function getTransactionByPhone($phoneNumber) {
            //$Phonenumber = $this->db->escape_string($Phonenumber);
            $query = "Select * from transaction where transaction.userID in 
            (select user.userID from user where phoneNumber like '$phoneNumber')";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                // Initialize an array to store transactions
                $transactions = array();
                
                // Loop through the result set and fetch each row
                while ($row = $result->fetch_assoc()) {
                    // Add each transaction to the transactions array
                    $transactions[] = $row;
                }
                
                // Return the array of transactions
                return $transactions;
            } else {
                // Return false if no transactions found
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
    public function displayTransactionDetails($transactionID) {
    $query = "SELECT * FROM `detail_transaction` WHERE `transactionID` = '$transactionID'";
    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        return $details;
    } else {
        return false;
    }
}

        }

        

    
    
    

?>

?>
