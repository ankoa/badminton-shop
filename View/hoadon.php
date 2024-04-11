<?php
    
    require_once '../Model/ModelTransaction.php';
   

    // Tạo một đối tượng ModelTransaction
    $modelTransaction = new ModelTransaction();
    
    // Lấy tất cả các giao dịch từ cơ sở dữ liệu
    $transactions = $modelTransaction->getAllTransactions();
    
    // Kiểm tra xem có giao dịch nào không
    if ($transactions) {
        // In ra tiêu đề của bảng
        echo "<table border='1'>
                <tr>
                    <th>Transaction ID</th>
                    <th>User ID</th>
                    <th>Total</th>
                    <th>Note</th>
                    <th>Time</th>
                    <th>Address</th>
                </tr>";
    
        // Duyệt qua từng giao dịch và in ra thông tin
        foreach ($transactions as $transaction) {
            $transactionObj = new Transaction(
                $transaction['transactionID'],
                $transaction['userID'],
                $transaction['total'],
                $transaction['note'],
                $transaction['time'],
                $transaction['address']
            );
    
            echo "<tr>
                    <td>".$transactionObj->getTransactionID()."</td>
                    <td>".$transactionObj->getUserID()."</td>
                    <td>".$transactionObj->getTotal()."</td>
                    <td>".$transactionObj->getNote()."</td>
                    <td>".$transactionObj->getTime()."</td>
                    <td>".$transactionObj->getAddress()."</td>
                  </tr>";
        }
    
        echo "</table>";
    } else {
        echo "Không có giao dịch nào.";
    }