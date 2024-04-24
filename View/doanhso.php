
<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Tạo một đối tượng ModelTransaction và gọi hàm displayTotalSales
    $modelTransaction = new ModelTransaction();
    $salesData = $modelTransaction->displayTotalSales($startDate, $endDate);

    // Return the sales data as JSON
    echo json_encode($salesData);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <script>
   function thongKe(event) {
    event.preventDefault(); // Prevent the default form behavior

    var startDate = document.getElementById('datestart2').value;
    var endDate = document.getElementById('dateend2').value;

    // Create an AJAX request to your PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'doanhso.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var salesData = JSON.parse(this.responseText);

            // Get the canvas element where the chart will be drawn
            var ctx = document.getElementById('salesChart').getContext('2d');

            // Define the chart data and options
            var chartData = {
                labels: salesData.labels,
                datasets: [{
                    label: 'Doanh số thu được',
                    data: salesData.sales,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            };

            var chartOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Create the chart
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });

            // Get the table element
            var table = document.getElementById('quanlydoanhso');

            // Clear the table
            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            // Populate the table with sales data
            for (var i = 0; i < salesData.labels.length; i++) {
                var row = table.insertRow(-1); // Insert a new row at the end of the table
                var cell1 = row.insertCell(0); // Insert a new cell in the row
                var cell2 = row.insertCell(1); // Insert a new cell in the row
                var cell3 = row.insertCell(2); // Insert a new cell in the row

                cell1.innerHTML = salesData.labels[i]; // Set the cell content (date)
                cell2.innerHTML = 'N/A'; // Set the cell content (quantity sold)
                cell3.innerHTML = salesData.sales[i]; // Set the cell content (sales amount)
            }
        }
    };

    // Send the form data in the AJAX request
    var formData = 'startDate=' + startDate + '&endDate=' + endDate;
    xhr.send(formData);
}
</script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<body>
    <div id="doanhso-content" class="content-section">
        <form id="frmdoanhso">
            <h1 style="padding-left: 10%;"> TÌM KIẾM THEO NGÀY</h1>
            <div class="containbox">
                <label for="datestart">Ngày bắt đầu:</label>
                <input type="date" id="datestart2">
            </div>
            <div class="containbox">
                <label for="dateend">Ngày kết thúc:</label>
                <input type="date" id="dateend2">
            </div>
            <button type="submit" style="margin-top: 10px; margin-left: 10px;" onclick="thongKe();"> Tìm kiếm </button>
            <h2 id="tongdoanhso">  </h2>
            <canvas id="salesChart" width="400" height="400"></canvas>

            <table class="tabledoanhso" id="quanlydoanhso" cellpadding="50" cellspacing="100"> 
                <thead>
                    <tr>
                        <th>Hãng</th>
                        <th>Số lượng bán</th>
                        <th>Doanh số thu được</th>
                    </tr>
                </thead>
            </table>
        </form>        
    </div>
</body>
</html>
