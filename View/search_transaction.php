<?php
// Kiểm tra xem có dữ liệu được gửi từ phía máy khách không
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['startDate']) && isset($_GET['endDate'])) {
    // Lấy ngày bắt đầu và kết thúc từ dữ liệu được gửi
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    // Thực hiện kết nối đến cơ sở dữ liệu và truy vấn dữ liệu dựa trên ngày bắt đầu và kết thúc
    require_once __DIR__ . '../../Model/ModelTransaction.php';
    $modelTransaction = new ModelTransaction();
    $transactions = $modelTransaction->getTransactionsByDate($startDate, $endDate);

    // Khởi tạo biến chứa nội dung của bảng
    $tableContent = '';

    // Hiển thị kết quả
    if ($transactions) {
        $tableContent .= "<table border='1'>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User ID</th>
                        <th>Total</th>
                        <th>Note</th>
                        <th>Time</th>
                        <th>Address</th>
                        <th>Pay</th>
                        <th>Transport</th>
                        <th>Name Receiver</th>
                        <th>Phone Receiver</th>
                        <th>Detail</th>
                        <th>Chuyển trạng thái</th>
                    </tr>";

        foreach ($transactions as $transaction) {
            $tableContent .= "<tr>";
            $tableContent .= "<td>" . $transaction->getTransactionID() . "</td>";
            $tableContent .= "<td>" . $transaction->getUserID() . "</td>";
            $tableContent .= "<td>" . $transaction->getTotal() . "</td>";
            $tableContent .= "<td>" . $transaction->getNote() . "</td>";
            $tableContent .= "<td>" . $transaction->getTime() . "</td>";
            $tableContent .= "<td>" . $transaction->getAddress() . "</td>";
            $tableContent .= "<td>" . $transaction->getCheck() . "</td>";
            $tableContent .= "<td>" . $transaction->getTransport() . "</td>";
            $tableContent .= "<td>" . $transaction->getNameReceiver() . "</td>";
            $tableContent .= "<td>" . $transaction->getPhoneReceiver() . "</td>";
            $tableContent .= "<td><button onclick='showTransactionDetails(" . $transaction->getTransactionID() . ")'>View Details</button></td>";
            $tableContent .= "<td>
                    <select id='status" . $transaction->getTransactionID() . "'>
                        <option value=''>Select Status</option>
                        <option value='Đang chờ duyệt'>Đang chờ duyệt</option>
                        <option value='Đã duyệt'>Đã duyệt</option>
                        <option value='Đang giao hàng'>Đang giao hàng</option>
                        <option value='Đã giao hàng'>Đã giao hàng</option>
                    </select>
                    <button onclick='changeTransactionStatus(" . $transaction->getTransactionID() . ")'>Save</button>
                  </td>";
            $tableContent .= "</tr>";
        }

        $tableContent .= "</table>";
    } else {
        $tableContent = "Không tìm thấy đơn hàng nào trong khoảng thời gian này.";
    }

    // Xuất nội dung của bảng
    echo $tableContent;
} else {
    echo "Invalid request";
}
?>