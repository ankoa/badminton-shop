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
            try {
                $query = "SELECT * FROM transaction";
                $result = $this->db->select($query);
                $arrHoaDon = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
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

        public function getTransaction($id) {
            try {
                $query = "SELECT * FROM transaction WHERE transactionID = '$id'";
                $result = $this->db->select($query);
                if ($row = mysqli_fetch_assoc($result)) {
                    return $row;
                }
                return null;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        }

        public function getTransactionByCustomer($ma_kh, $search) {
            try {
                $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction
                    WHERE userID = '$ma_kh' 
                    AND transactionID = '$search'
                    AND status = 1
                    ORDER BY transactionID DESC
                ";
                $result = $this->db->select($query);
                $arrHoaDon = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        }
        
        public function getAllTransactionByCustomer($ma_kh) {
            try {
                $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction
                    WHERE userID = '$ma_kh'
                    AND status = 1 
                    ORDER BY transactionID DESC";
                $result = $this->db->select($query);
                $arrHoaDon = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        }

        public function getTransactionByPhone($phoneNumber) {
            //$Phonenumber = $this->db->escape_string($Phonenumber);
            $query = "SELECT *, , DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction WHERE transaction.userID in 
            (SELECT user.userID FROM user WHERE phoneNumber = '$phoneNumber')
            ORDER BY transactionID DESC";
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

        public function deleteHoaDon($status,$ma_hd) {
            try {
                $query = "UPDATE transaction SET status = $status WHERE transactionID = '$ma_hd'";
                $result = $this->db->select($query);
                return $result;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return false;
            }
        }

        public function getAllDeleteHoaDon() {
            try {
                $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction WHERE status = 0";
                $result = $this->db->select($query);
                $arrHoaDon = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        }
    
        // Phương thức để thêm một giao dịch mới vào cơ sở dữ liệu
        public function addTransaction($userID, $total, $note, $time, $address, $status) {
            $query = "INSERT INTO `transaction` (`userID`, `total`, `note`, `time`, `address`, 'status') 
                      VALUES ('$userID', '$total', '$note', '$time', '$address', '$status')";
            return $this->db->insert($query);
        }
    
        // Phương thức để cập nhật thông tin của một giao dịch trong cơ sở dữ liệu
        public function updateTransaction($transactionID, $userID, $total, $note, $time, $address,$status) {
            $query = "UPDATE `transaction` 
                      SET `userID` = '$userID', `total` = '$total', `note` = '$note', `time` = '$time', `address` = '$address', `status` = '$status' 
                      WHERE `transactionID` = '$transactionID'";
            return $this->db->update($query);
        }
    
        // Phương thức để xóa một giao dịch khỏi cơ sở dữ liệu
        public function deleteTransaction($transactionID) {
            $query = "DELETE FROM `transaction` WHERE `transactionID` = '$transactionID'";
            return $this->db->delete($query);
        }

        // Phương thức để thống kê doanh số từ cơ sở dữ liệu
        // Trong phương thức displayTotalSales của class ModelTransaction
        // Trong phương thức displayTotalSales của class ModelTransaction
        public function displayTotalSales($startDate, $endDate) {
            $query = "SELECT DATE(`time`) as date, SUM(`total`) as totalSales 
                    FROM `transaction` 
                    WHERE `time` BETWEEN '$startDate' AND '$endDate' 
                    GROUP BY DATE(`time`)";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $salesData = array(
                    'labels' => array(),
                    'sales' => array()
                );
                while ($row = $result->fetch_assoc()) {
                    $salesData['labels'][] = $row['date'];
                    // Chuyển đổi dữ liệu doanh số từ chuỗi sang số
                    $salesData['sales'][] = (float) $row['totalSales'];
                }
                return $salesData;
            } else {
                return false;
            }
        }

        // Phương thức để hiển thị chi tiết hóa đơn
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

        public function updateTransactionStatus($transactionID, $newStatus) {
            $sql = "UPDATE `transaction` SET `status` = '$newStatus' WHERE `transactionID` = $transactionID";
            return $this->db->update($sql);
        }

        public function getTotalSales($startDate, $endDate) {
            $query = "SELECT DATE(`time`) as date, SUM(`total`) as totalSales 
                    FROM `transaction` 
                    WHERE `time` BETWEEN '$startDate' AND '$endDate' 
                    GROUP BY DATE(`time`)";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $totalSalesData = array(
                    'labels' => array(),
                    'totalSales' => array()
                );
                while ($row = $result->fetch_assoc()) {
                    $totalSalesData['labels'][] = $row['date'];
                    $totalSalesData['totalSales'][] = (float) $row['totalSales'];
                }
                return $totalSalesData;
            } else {
                return false;
            }
        }
        public function getTotalSalesByBrand($startDate, $endDate) {
            $query = "SELECT b.name as brandName, SUM(dt.subtotal) as totalSales 
                    FROM detail_transaction dt
                    JOIN transaction t ON dt.transactionID = t.transactionID
                    JOIN product p ON dt.productID = p.productID
                    JOIN brand b ON p.brandID = b.brandID
                    WHERE t.time BETWEEN '$startDate' AND '$endDate'
                    GROUP BY b.name";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $totalSalesData = array(
                    'labels' => array(),
                    'totalSales' => array()
                );
                while ($row = $result->fetch_assoc()) {
                    $totalSalesData['labels'][] = $row['brandName'];
                    $totalSalesData['totalSales'][] = (float) $row['totalSales'];
                }
                return $totalSalesData;
            } else {
                return false;
            }
        }

}

        

    
    
    

?>
