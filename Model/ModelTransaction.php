<?php 
require_once 'database.php';
require_once '../Model/Entity/Transaction.php';

class ModelTransaction {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all transactions from the database
    public function getAllTransactions() {
        $query = "SELECT * FROM `transaction`";
        $result = $this->db->select($query);
        if ($result) {
            $transactions = [];
            while ($row = $result->fetch_assoc()) {
                $transactions[] = new Transaction(
                    $row['transactionID'],
                    $row['userID'],
                    $row['total'],
                    $row['note'],
                    $row['time'],
                    $row['address'],
                    $row['check'],
                    $row['transport'],
                    $row['status'],
                    $row['name_receiver'],
                    $row['phone_receiver']
                );
            }
            return $transactions;
        } else {
            return false;
        }
    }

    // Method to get a transaction by ID
    public function getTransactionByID($transactionID) {
        $query = "SELECT * FROM `transaction` WHERE `transactionID` = '$transactionID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return new Transaction(
                $row['transactionID'],
                $row['userID'],
                $row['total'],
                $row['note'],
                $row['time'],
                $row['address'],
                $row['check'],
                $row['transport'],
                $row['status'],
                $row['name_receiver'],
                $row['phone_receiver']
            );
        } else {
            return false;
        }
    }

    // Method to add a new transaction to the database
    public function addTransaction($userID, $total, $note, $time, $address, $check, $transport, $status, $nameReceiver, $phoneReceiver) {
        $query = "INSERT INTO `transaction` (`userID`, `total`, `note`, `time`, `address`, `check`, `transport`, `status`, `name_receiver`, `phone_receiver`) 
                  VALUES ('$userID', '$total', '$note', '$time', '$address', '$check', '$transport', '$status', '$nameReceiver', '$phoneReceiver')";
        return $this->db->insert($query);
    }

    // Method to update an existing transaction in the database
    public function updateTransaction($transactionID, $userID, $total, $note, $time, $address, $check, $transport, $status, $nameReceiver, $phoneReceiver) {
        $query = "UPDATE `transaction` 
                  SET `userID` = '$userID', `total` = '$total', `note` = '$note', `time` = '$time', `address` = '$address', 
                      `check` = '$check', `transport` = '$transport', `status` = '$status', `name_receiver` = '$nameReceiver', `phone_receiver` = '$phoneReceiver'
                  WHERE `transactionID` = '$transactionID'";
        return $this->db->update($query);
    }

    // Method to delete a transaction from the database
    public function deleteTransaction($transactionID) {
        $query = "DELETE FROM `transaction` WHERE `transactionID` = '$transactionID'";
        return $this->db->delete($query);
    }

    // Method to display total sales from the database
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
                $salesData['sales'][] = (float) $row['totalSales'];
            }
            return $salesData;
        } else {
            return false;
        }
    }

    // Method to display transaction details
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

    // Method to update the status of a transaction


    // Method to get total sales
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

    // Method to get total sales by brand
    public function getTotalSalesByBrand($startDate, $endDate) {
        $query = "SELECT b.name as brandName, SUM(dt.total_amonut) as totalSales 
                  FROM ordertransaction dt
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

    // Method to get transactions by date
    public function getTransactionsByDate($startDate, $endDate) {
        $query = "SELECT * FROM `transaction` WHERE `time` BETWEEN '$startDate' AND '$endDate'";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $transactions = [];
            while ($row = $result->fetch_assoc()) {
                $transactions[] = new Transaction(
                    $row['transactionID'],
                    $row['userID'],
                    $row['total'],
                    $row['note'],
                    $row['time'],
                    $row['address'],
                    $row['check'],
                    $row['transport'],
                    $row['status'],
                    $row['name_receiver'],
                    $row['phone_receiver']
                );
            }
            return $transactions;
        } else {
            return false;
        }
    }
    public function updateTransactionStatus($transactionID, $newStatus) {
        $query = "UPDATE `transaction` SET `transport` = '$newStatus' WHERE `transactionID` = '$transactionID'";
        return $this->db->update($query);
    }
}
?>
