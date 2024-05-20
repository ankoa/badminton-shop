<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./Badminton_Admin.css">

    <title>Admin</title>
    <script>
      function showContent(contentId) {
     
     var contentSections = document.getElementsByClassName('content-section');
     for (var i = 0; i < contentSections.length; i++) {
         contentSections[i].style.display = 'none';
     }

  
     var selectedContent = document.getElementById(contentId);
     if (selectedContent) 
         selectedContent.style.display = 'block';}

 // Function to save the current content section to localStorage
function saveCurrentContent(contentId) {
    localStorage.setItem('currentContent', contentId);
}

// Function to show the content section based on localStorage data
function restoreContent() {
    var currentContent = localStorage.getItem('currentContent');
    if (currentContent) {
        var contentSections = document.getElementsByClassName('content-section');
        for (var i = 0; i < contentSections.length; i++) {
            contentSections[i].style.display = 'none';
        }
        var selectedContent = document.getElementById(currentContent);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
    }
}

// Call restoreContent() when the page is loaded to restore the previous content section
window.onload = restoreContent;

        </script>

<script>
 // JavaScript để hiển thị và ẩn popup
 function showPopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'block';
    }

    function closePopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'none';
    }

    // Thêm sự kiện click cho nút "Chi tiết"
    function showTransactionDetails(transactionID) {
        // Tạo yêu cầu AJAX để lấy chi tiết hóa đơn từ máy chủ
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'ViewDetail.php?transactionID=' + transactionID, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Hiển thị nội dung chi tiết hóa đơn trong popup
                document.getElementById('popup-details').innerHTML = this.responseText;
                // Hiển thị popup
                showPopup();
            }
        };
        xhr.send();
    
}
function changeTransactionStatus(transactionID) {
    // Log to console for debugging
    console.log('changeTransactionStatus called with transactionID:', transactionID);

    // Get the new status from the combobox
    var newStatus = document.getElementById('status' + transactionID).value;

    // Log to console for debugging
    console.log('New status:', newStatus);

    // Create an AJAX request to update the status
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_transaction_status.php?transactionID=' + encodeURIComponent(transactionID) + '&status=' + encodeURIComponent(newStatus), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            console.log('Server response:', response);
            if (response === 'success') {
                alert('Cập nhật trạng thái thành công!');
                window.location.reload();
            } else {
                alert('Cập nhật trạng thái thất bại!');
            }
        }
    };

    // Send the request
    xhr.send();
}





var myChart; // Declare the myChart variable outside the function

function thongKe(event) {
    event.preventDefault(); // Prevent the default form behavior

    var startDate = document.getElementById('datestart2').value;
    var endDate = document.getElementById('dateend2').value;

    // Create an AJAX request to your PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'doanhso.php?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(this.responseText);

            // Check if the response contains an error
            if (response.error) {
                alert(response.error); // Display the error message
                return; // Exit the function
            }

            var salesData = response;

            // Check if salesData is empty
            if (!salesData || salesData.labels.length === 0 || salesData.sales.length === 0) {
                alert('Không có đơn hàng nào trong khoảng thời gian này.');
                return;
            }

            // Get the canvas element where the chart will be drawn
            var ctx = document.getElementById('salesChart').getContext('2d');
            ctx.canvas.width = 300;
            ctx.canvas.height = 200;

            // Destroy the old charts if they exist
            if (myChart) {
                myChart.destroy();
            }
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

            // Create the chart using the existing myChart variable
            myChart = new Chart(ctx, {
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
            table.innerHTML = '';
            // Populate the table with sales data
            for (var i = 0; i < salesData.labels.length; i++) {
                var row = table.insertRow(-1); // Insert a new row at the end of the table
                var cell1 = row.insertCell(0); // Insert a new cell in the row
                var cell2 = row.insertCell(1); // Insert a new cell in the row
                var headerRow = table.insertRow(0);
                var brandHeader = headerRow.insertCell(0);
                brandHeader.innerHTML = 'Ngày';
                var salesHeader = headerRow.insertCell(1);
                salesHeader.innerHTML = 'Doanh số';
                cell1.innerHTML = salesData.labels[i];
                cell2.innerHTML = salesData.sales[i];
            }

            // Calculate total sales
            var totalSales = salesData.sales.reduce((a, b) => a + b, 0);

            // Add a new row to display total sales
            var totalRow = table.insertRow(-1);
            var totalCell1 = totalRow.insertCell(0);
            var totalCell2 = totalRow.insertCell(1);

            totalCell1.innerHTML = "Tổng";
            totalCell2.innerHTML = totalSales;
        }
    };

    // Send the request
    xhr.send();
}

function thongKeByBrand(event) {
    event.preventDefault(); // Prevent the default form behavior

    var startDate = document.getElementById('datestart2').value;
    var endDate = document.getElementById('dateend2').value;

    // Create an AJAX request to your new PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'doanhsotheohang.php?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log("Raw response: ", this.responseText); // Log the raw response
                try {
                    var response = JSON.parse(this.responseText);

                    // Check if the response contains an error
                    if (response.error) {
                        alert(response.error); // Display the error message
                        return; // Exit the function
                    }

                    var salesData = response;
                    console.log("Start Date: " + startDate);
                    console.log("End Date: " + endDate);

                    // Check if salesData is empty
                    if (!salesData || salesData.labels.length === 0 || salesData.totalSales.length === 0) {
                        alert('Không có đơn hàng nào trong khoảng thời gian này.');
                        return;
                    }

                    // Log the sales data to verify its structure
                    console.log("Parsed sales data: ", salesData);

                    // Check if salesData contains the expected properties
                    if (!salesData || !Array.isArray(salesData.labels) || !Array.isArray(salesData.totalSales)) {
                        throw new Error("Invalid data structure");
                    }

                    // Get the canvas element where the chart will be drawn
                    var ctx = document.getElementById('salesChart').getContext('2d');

                    // Destroy the old chart if it exists
                    if (window.myChart) {
                        window.myChart.destroy();
                    }

                    // Define the chart data and options
                    var chartData = {
                        labels: salesData.labels, // This will now be brand IDs
                        datasets: [{
                            label: 'Tổng doanh số',
                            data: salesData.totalSales, // This will now be total sales by brand
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    };

                    var chartOptions = {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    };

                    // Create the new chart
                    window.myChart = new Chart(ctx, {
                        type: 'bar',
                        data: chartData,
                        options: chartOptions
                    });

                    // Display the table for sales by brand
                    displaySalesTableByBrand(salesData.labels, salesData.totalSales);
                } catch (e) {
                    console.error("Error processing the response: ", e.message);
                    alert('Có lỗi xảy ra khi xử lý dữ liệu. Vui lòng thử lại.');
                }
            } else {
                console.error("Error with the request: ", xhr.statusText);
                alert('Có lỗi xảy ra khi lấy dữ liệu. Vui lòng thử lại.');
            }
        }
    };

    xhr.send();
}

function displaySalesTableByBrand(labels, totalSales) {
    // Get the table element
    var table = document.getElementById('quanlydoanhso');

    // Clear the table
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }
    table.innerHTML = '';
    // Populate the table with sales data
    for (var i = 0; i < labels.length; i++) {
        var row = table.insertRow(-1); // Insert a new row at the end of the table
        var cell1 = row.insertCell(0); // Insert a new cell in the row
        var cell2 = row.insertCell(1); // Insert a new cell in the row
        var headerRow = table.insertRow(0);
        var brandHeader = headerRow.insertCell(0);
        brandHeader.innerHTML = 'Ngày';
        var salesHeader = headerRow.insertCell(1);
        salesHeader.innerHTML = 'Doanh số';
        cell1.innerHTML = labels[i];
        cell2.innerHTML = totalSales[i];
    }

    // Calculate total sales
    var totalSalesSum = totalSales.reduce((a, b) => a + b, 0);

    // Add a new row to display total sales
    var totalRow = table.insertRow(-1);
    var totalCell1 = totalRow.insertCell(0);
    var totalCell2 = totalRow.insertCell(1);

    totalCell1.innerHTML = "Tổng";
    totalCell2.innerHTML = totalSalesSum;
}

function searchTransactionsByDate() {
    var startDate = document.getElementById('datestart1').value;
    var endDate = document.getElementById('dateend1').value;
    var transport = document.getElementById('transport').value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', `search_transaction.php?startDate=${startDate}&endDate=${endDate}&transport=${transport}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.error) {
                alert(response.error);
            } else {
                document.getElementById('hoadontable').innerHTML = response.tableContent;
            }
        }
    };
    xhr.send();
}

function searchTransactionsByDate() {
    // Lấy ngày bắt đầu và kết thúc từ input
    var startDate = document.getElementById("datestart1").value;
    var endDate = document.getElementById("dateend1").value;

    // Tạo đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Xác định phương thức và URL của yêu cầu
    xhr.open("GET", "search_transaction.php?startDate=" + startDate + "&endDate=" + endDate, true);

    // Xử lý khi nhận được phản hồi từ máy chủ
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var tableContent = xhr.responseText;
                document.getElementById("hoadontable").innerHTML = tableContent;
            }
        }
    };

    // Gửi yêu cầu tìm kiếm đến máy chủ
    xhr.send();
}
function changeUserStatus(userID, newStatus) {
            var xhr = new XMLHttpRequest();
            // Construct the URL with query parameters
            var url = "change_user_status.php?userID=" + userID + "&newStatus=" + newStatus;
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        if (newStatus == 0) {
                            buttonElement.innerText = 'Bỏ chặn';
                            buttonElement.setAttribute('onclick', 'changeUserStatus("' + userID + '", 1, this)');
                        } else {
                            buttonElement.innerText = 'Chặn';
                            buttonElement.setAttribute('onclick', 'changeUserStatus("' + userID + '", 0, this)');
                        }
                        // Reload the page to reflect the changes
                        alert('Cập nhật trạng thái thành công!');
                    } else {
                        console.error('Error occurred: ' + xhr.status);
                    }
                }
            };
            // No need to set Content-Type for GET requests
            xhr.send();
        }




    </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    <body>
        <div>
        <div class="top_header">
        
        </div>
        </div>
        
        <div id="menu">
        <ul>
                   <li class="icon" ><i class="fa-solid fa-house"></i><a href="#" onclick="saveCurrentContent('home-content'); showContent('home-content')">Trang chủ </a></li>
                    <li class="icon" id="taikhoan"><i class="fa-solid fa-user"></i><a href="#" onclick="saveCurrentContent('taikhoan-content');showContent('taikhoan-content')">Quản lý tài khoản</a></li>
                    <li class="icon" id="sanpham"><i class="fa-solid fa-laptop"></i><a href="#" onclick="saveCurrentContent('sanpham-content');showContent('sanpham-content')">Quản lý sản phẩm</a></li>
                    <li class="icon" id="loaisanpham"><i class="fa-solid fa-laptop"></i><a href="#" onclick="saveCurrentContent('loaisanpham-content');showContent('loaisanpham-content')">Quản lý loại sản phẩm</a></li>
                    <li class="icon" id="hoadon"><i class="fa-solid fa-receipt"></i><a href="#" onclick="saveCurrentContent('hoadon-content');showContent('hoadon-content')">Quản lý hóa đơn</a></li>
                    <li class="icon" id="doanhso"><i class="fa-solid fa-chart-simple"></i><a href="#" onclick="saveCurrentContent('doanhso-content');showContent('doanhso-content')">Doanh số</a></li>
                    <li class="icon" id="dangxuat"><i class="fa-solid fa-right-from-bracket"></i><a href="#"  onclick="logout()">Đăng xuất</a></li>
                    
                </ul>
        </div>
        <div id="home-content" class="content-section"> 
                <div class="selling-products">
                    <h1 class="text-center headerad">QUẢN LÝ CỬA HÀNG CẦU LÔNG</h1>
                    <div class="item-selling-products" id="item-selling-products">
                

                
                        </div>
                </div>   
            </div>
        

    <div id="taikhoan-content" class="content-section">
        <div class="headerad">Quản lý tài khoản</div>
        <?php

    require_once __DIR__ . '../../Model/ModelUser.php'; 

    $modelUser = new ModelUser();

    // Get all users
    $users = $modelUser->getAllUsers();

        if ($users) {
            echo "<table border='1'>
                    <tr>
                        <th>Mã người dùng</th>
                        <th>Username</th>
                        <th>Mật khẩu</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Điểm</th>
                        <th>Vai trò</th>
                        <th>Phân loại</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>";

            foreach ($users as $user) {
                echo "<tr>
                    <td>" . $user['userID'] . "</td>
                    <td>" . $user['username'] . "</td>
                    <td>" . $user['password'] . "</td>
                    <td>" . $user['name'] . "</td>
                    <td>" . $user['mail'] . "</td>
                    <td>" . $user['phoneNumber'] . "</td>
                    <td>" . $user['point'] . "</td>
                    <td>";
                // Hiển thị vai trò dựa trên roleID
                switch ($user['roleID']) {
                    case 1:
                        echo "Admin";
                        break;
                    case 2:
                        echo "Manager";
                        break;
                    case 3:
                        echo "Saler";
                        break;
                    case 4:
                        echo "Tester";
                        break;
                    default:
                        echo "Unknown";
                }
                echo "</td>
                <td>" . $user['type'] . "</td>
                    <td>" . ($user['status'] == 1 ? 'Hoạt động' : 'Vô hiệu hóa') . "</td>
                    <td>";

                if ($user['roleID'] != 1) {
                    $buttonText = $user['status'] == 1 ? 'Chặn' : 'Bỏ chặn';
                    $newStatus = $user['status'] == 1 ? 0 : 1;
                    echo "<button onclick='changeUserStatus(\"" . $user['userID'] . "\", " . $newStatus . ", this)'>$buttonText</button>";
                }
                echo "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Không tìm thấy người dùng!";
        }
    ?>

         <script>
            // Mở popup chỉnh sửa sản phẩm khi bấm vào liên kết
document.querySelectorAll('#openEditUser').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

        // Hiển thị modal form
        document.getElementById("editUser").style.display = "block";

        // Lấy các dữ liệu từ hàng chứa nút "Sửa" tương ứng
        let row = this.closest('tr');
        let userID = row.querySelector('td:nth-child(1)').innerText;
        let username = row.querySelector('td:nth-child(2)').innerText;
        let password = row.querySelector('td:nth-child(3)').innerText;
        let name = row.querySelector('td:nth-child(4)').innerText;
        let mail = row.querySelector('td:nth-child(5)').innerText;
        let phoneNumber = row.querySelector('td:nth-child(6)').innerText;
        let point = row.querySelector('td:nth-child(7)').innerText;
        let role = row.querySelector('td:nth-child(8)').innerText.trim(); 
        let type = row.querySelector('td:nth-child(9)').innerText;
        let status = row.querySelector('td:nth-child(10)').innerText.trim(); 

        // Gán giá trị cho các trường dữ liệu trong form
        document.getElementById("userID").value = userID;
        document.getElementById("username").value = username;
        document.getElementById("password").value = password;
        document.getElementById("name").value = name;
        document.getElementById("mail").value = mail;
        document.getElementById("phoneNumber").value = phoneNumber;
        document.getElementById("point").value = point;
        document.getElementById("type").value = type;

        // Gán giá trị cho thẻ select role
        let roleSelect = document.querySelector('select[name="role"]');
        switch (role) {
            case 'Admin':
                roleSelect.value = 1;
                break;
            case 'Manager':
                roleSelect.value = 2;
                break;
            case 'Saler':
                roleSelect.value = 3;
                break;
            case 'Tester':
                roleSelect.value = 4;
                break;
            default:
                roleSelect.value = '';
        }

        // Gán giá trị cho thẻ select status
        let statusSelect = document.querySelector('select[name="status"]');
        if (status === 'Hoạt động') {
            statusSelect.value = 1;
        } else if (status === 'Vô hiệu hóa') {
            statusSelect.value = 0;
        } else {
            statusSelect.value = '';
        }
    });
});

// Đóng popup chỉnh sửa sản phẩm khi bấm vào nút "Đóng"
function closeEditUser() {
    document.getElementById("editUser").style.display = "none";
}

        </script>

        <div id="editUser" class="modal" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
            <form class="modal-content" action="change_user_information.php" method="POST" style="width:35%; margin-left:35%; margin-top:3%; border:solid 2px;">
                <span style="margin-left:95%" class="close" onclick="closeEditUser()">&times;</span>
                <h1 style="text-align: center;">Chỉnh sửa sản phẩm</h1>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Mã người dùng</label>
                    <input type="text" name="userID" id="userID" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="user-select: none; pointer-events: none; caret-color: transparent;">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Username</label>
                    <input type="text" name="username" id="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Mật khẩu</label>
                    <input type="text" name="password" id="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Tên</label>
                    <input type="text" name="name" id="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Email</label>
                    <input type="text" name="mail" id="mail" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Số điện thoại</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Điểm</label>
                    <input type="text" name="point" id="point" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Quyền</label>
                    <select name="roleID" class="form-select form-select-sm" aria-label=".form-select-sm example" value="">
                        <option value="2">Manager</option>
                        <option value="3">Saler</option>
                        <option value="4">Tester</option>
                    </select>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Phân loại</label>
                    <input type="text" name="type" id="type" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Trạng thái</label>
                    <select name="status" class="form-select form-select-sm" aria-label=".form-select-sm example" value="">           
                        <option value="1">Hoạt động</option>
                        <option value="0">Vô hiệu hoá</option>
                    </select>
                </div>
                <button type="submit" style="width:55px; height:auto; margin-left:45%">Lưu</button>
            </form>
        </div>  
    </div>
        
          <div id="loaisanpham-content" class="content-section">
                <div class="headerad"> QUẢN LÝ LOẠI SẢN PHẨM</div>
        
    <?php
    require_once __DIR__ . '/../Model/ModelBrand.php';

    $modelBrand = new ModelBrand();

    $brands = $modelBrand->getAllBrands();
    if ($brands) {
        echo "<table border='1'>
                <tr>
                    <th>Brand ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";
        foreach ($brands as $brand) {
            // Assuming $modelBrand->getAllBrands() returns an array of objects of type Brand
            echo "<tr>
                    <td>" . $brand->getBrandID() . "</td>
                    <td>" . $brand->getName() . "</td>
                    <td>" . $brand->getDescription() . "</td>
                    <td>" . $brand->getStatus() . "</td>
                    <td>
                    <form method='get'>
                    <input type='hidden' name='brand_id' value='" . $brand->getBrandID() . "'>
                    <button type='submit' name='delete_brand'>Ngừng kinh doanh</button>
                    </td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
            <?php
    require_once __DIR__ . '/../Model/ModelBrand.php';

    // Function to add a new brand
    function addBrand($name, $description, $status) {
        $modelBrand = new ModelBrand();
        return $modelBrand->addBrand($name, $description, $status);
    }

    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['add_brand']) && isset($_GET['productBrand']) && isset($_GET['motatxt'])) {
        $name = $_GET['productBrand'];
        $description = $_GET['motatxt'];
        $status = '1';
        
        // Call the function to add the brand
        $result = addBrand($name, $description, $status);
        
        if ($result) {
            // Brand added successfully
            // You can redirect or show a success message here
            echo "<script>alert('Thêm loại sản phẩm thành công!');</script>";
            echo "<script>window.location.href = 'http://localhost/badminton-shop-main/View/Badminton_Admin.php';</script>"; // 
        
        

        } else {
            // Failed to add brand
            // You can redirect or show an error message here
            echo "<script>alert('Thêm loại sản phẩm thất bại');</script>";
            echo "<script>window.location.href = 'http://localhost/badminton-shop-main/View/Badminton_Admin.php';</script>"; // 

        }
    }
    function deleteBrand($brandID) {
        $modelBrand = new ModelBrand();
    
        return $modelBrand->deleteBrand($brandID);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_brand']) && isset($_GET['brand_id'])) {
        $brandID = $_GET['brand_id'];
        

        $result = deleteBrand($brandID);
        
        if ($result) {
     
            echo "<script>alert('Xóa loại sản phẩm thành công!');</script>";
            echo "<script>window.location.href = 'http://localhost/badminton-shop-main/View/Badminton_Admin.php';</script>"; 
        } else {
            // Failed to delete brand
            // You can redirect or show an error message here
            echo "<script>alert('Xóa loại sản phẩm thất bại');</script>";
            echo "<script>window.location.href = 'http://localhost/badminton-shop-main/View/Badminton_Admin.php';</script>"; 
        }
    }
    
    ?>
    <form id="frmnhaploaisp" method="get">
        <h1 style="color: red;"> Thêm loại sản phẩm </h1>
        <div class="containbox">
            <label for="productName">Tên loại phẩm:</label>
            <input type="text" id="productBrand" name="productBrand">
        </div>
        <div class="containbox">
            <label for="productName">Mô tả:</label>
            <input type="text" id="motatxt" name="motatxt">
        </div>
        <div class="containbox">
            <button type="submit" name="add_brand">Thêm loại sản phẩm</button>
        </div>
    </form>

        </div>

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
                <button type="submit" style="margin-top: 10px; margin-left: 10px;" onclick="thongKe(event);"> Thống kê doanh số  </button>
                <button type="submit" style="margin-top: 10px; margin-left: 10px;" onclick="thongKeByBrand(event);"> Thống kê doanh số theo hãng </button>
                    <h2 id="tongdoanhso">  </h2>
                    <canvas id="salesChart" width="400" height="400"></canvas>
                    <table class="tabledoanhso" id="quanlydoanhso" cellpadding="50" cellspacing="100"> 
                        
                        <thead>
                    <tr>
                  
                    </tr>
                    </thead>
                    </table>
                
            </form>        
        </div>
        </div>



    <!-- Quản lý sản phẩm -->
    <div id="sanpham-content" class="content-section">
        <h1 class="headerad"> QUẢN LÝ SẢN PHẨM</h1>
        <div class="row">
            <div class="col-lg-8">
                <?php
                require_once '../Model/ModelProduct.php';
                require_once '../Model/ModelBrand.php';
                require_once '../Model/ModelCatalog.php';
                $ModelProduct = new ModelProduct();
                $products = $ModelProduct->getAllProducts();
                $ModelBrand = new ModelBrand();
                $brands = $ModelBrand->getAllBrands();
                $ModelCatalog = new ModelCatalog();
                $catalogs = $ModelCatalog->getAllCatalogs();
                if ($products) {
                    echo ' <table class="table" style="width: 50;">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Mã sản phẩm</th>
                                    <th class="text-center" scope="col">Mã thương hiệu</th>
                                    <th class="text-center" scope="col">Mã danh mục</th>
                                    <th class="text-center" scope="col">Sản phẩm</th>
                                    <th class="text-center" scope="col">Giá</th>
                                    <th class="text-center" scope="col">Giảm giá</th>
                                    <th class="text-center" scope="col">Trạng thái</th>
                                    <th class="text-center" scope="col">Mô tả</th>
                                    <th class="text-center" scope="col">Hình ảnh</th>
                                    <th class="text-center" scope="col">Chỉnh sửa</th>
                                </tr>
                            </thead>';
                    foreach ($products as $product) {
                        echo "
                                <tbody>
                                <tr>
                                    <td class='text-center'>{$product->productID}</td>
                                    <td class='text-center'>{$product->brandID}</td>
                                    <td class='text-center'>{$product->catalogID}</td>
                                    <td class='text-center'>{$product->name}</td>
                                    <td class='text-center'>{$product->price} VNĐ</td>
                                    <td class='text-center'>{$product->discount}%</td>
                                    <td class='text-center'>{$product->status}</td>
                                    <td class='text-center'>{$product->description}</td>
                                    <td class='text-center'><img src='{$product->image}' alt='Hình ảnh' style='max-width: 100px; max-height: 100px;'></td>
                                    <td style='display:flex; justify-content:space-around; width: 150px'>
                                        <button id='openEditModal' data-productid = {$product->productID}>Cập nhật</button>
                                        <button id='confirmDelete' data-productid = {$product->productID}>Xoá</button>
                                    </td>
                                </tr>
                                </tbody>
                            ";
                    }
                    echo "</table>";
                }
                ?>

            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3">

                <form id="frmnhapsp" action="Create.php" method="POST">
                    <h1 style="color: black;text-align:center;"> Thêm sản phẩm </h1>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Giá</label>
                        <input type="text" name="price" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Giảm giá</label>
                        <input type="text" name="discount" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <select name="status" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <label class="input-group-text" id="inputGroup-sizing-sm">Trạng thái</label>
                            <option selected>Trạng thái</option>
                            <option value="1">Hoạt động</option>
                            <option value="0">Vô hiệu hoá</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Mô tả</label>
                        <input type="textarea" name="description" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="containbox">
                        Hình ảnh: <input type="file" name="image" id="image" accept="image/*">
                    </div>


                    <div class="containbox">
                        <button type="submit" style="width:auto; height:auto;">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Đoạn js để popup bảng chỉnh sửa sản phẩm -->
        <script>
            // Mở popup chỉnh sửa sản phẩm khi bấm vào liên kết
            document.querySelectorAll('#openEditModal').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        
         // Hiển thị modal form
         document.getElementById("editModal").style.display = "block";
         
        // Lấy các dữ liệu từ hàng chứa nút "Sửa" tương ứng
        let productId = this.getAttribute('data-productid');
        let row = this.closest('tr');
        let productID = row.querySelector('td:nth-child(1)').innerText;
        let productName = row.querySelector('td:nth-child(4)').innerText;
        let productPrice = row.querySelector('td:nth-child(5)').innerText;
        let productDiscount = row.querySelector('td:nth-child(6)').innerText;
        let productStatus = row.querySelector('td:nth-child(7)').innerText;
        let productDescription = row.querySelector('td:nth-child(8)').innerText;
        let productImageSrc = row.querySelector('td:nth-child(9) img').getAttribute('src');
        
        // Gán giá trị cho các trường dữ liệu trong form

        document.getElementById("productID").value = productID;
        document.getElementById("name").value = productName;
        document.getElementById("price").value = productPrice.replace(' VNĐ', '');
        document.getElementById("discount").value = productDiscount.replace('%', '');
        document.querySelector('select[name="status"]').value = productStatus;
        document.getElementById("description").value = productDescription;
        document.getElementById("existingImage").setAttribute('src', productImageSrc);
        
       
    });
});

// Hàm đóng modal form
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

// Hàm xoá hình hiện tại
function removeExistingImage() {
    document.getElementById("existingImage").setAttribute('src', '');
}


            // Đóng popup chỉnh sửa sản phẩm khi bấm vào nút "Đóng"
            function closeEditModal() {
                document.getElementById("editModal").style.display = "none";
            }

            document.querySelectorAll('#confirmDelete').forEach(button => {
                button.addEventListener('click', function() {
                    // Lấy ID sản phẩm từ thuộc tính data-productid của button
                    var ProductID = this.getAttribute('data-productid');
                    // Hiển thị hộp thoại xác nhận
                    var deleteConfirmation = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?');
                    // Nếu người dùng chọn "OK"
                    if (deleteConfirmation) {
                        // Chuyển hướng đến trang Delete.php để xóa sản phẩm
                        window.location.href = 'Delete.php?productID=' + ProductID;
                    }
                });
            });

            //Xoá ảnh cũ
            function removeExistingImage() {
                // Clear the existing image and reset the input field
                var existingImage = document.getElementById('existingImage');
                var deleteImageConfirmation = window.confirm("Bạn có muốn xoá ảnh cũ?");
                if (deleteImageConfirmation) {
                    existingImage.value = '';
                }

                //  var editProductImageInput = document.getElementById('editProductImageInput');
                //  editProductImageInput.value = '';
            }
        </script>

        <!-- Bảng chỉnh sửa sản phẩm -->

        <div id="editModal" class="modal" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
            <form class="modal-content" action="Update.php" method="POST" style="width:35%; margin-left:35%; margin-top:3%; border:solid 2px;">
                <span style="margin-left:95%" class="close" onclick="closeEditModal()">&times;</span>
                <h1 style="text-align: center;">Chỉnh sửa sản phẩm</h1>   
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Mã sản phẩm</label>
                    <input type="text" name="productID" id="productID" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" style="user-select: none; pointer-events: none; caret-color: transparent;">
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Sản phẩm</label>
                    <input type="text" name="name" id="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Giá</label>
                    <input type="text" name="price" id="price" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Giảm giá</label>
                    <input type="text" name="discount" id="discount" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="input-group input-group-sm mb-3">
                        <select name="status" class="form-select form-select-sm" aria-label=".form-select-sm example" value="">
                            <label class="input-group-text" id="inputGroup-sizing-sm">Trạng thái</label>
                            <option selected>Trạng thái</option>
                            <option value="1">Hoạt động</option>
                            <option value="0">Vô hiệu hoá</option>
                        </select>
                    </div>

                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" id="inputGroup-sizing-sm">Mô tả</label>
                    <input type="text" name="description" id="description" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                </div>

                <div class="containboximg">
                    <label for="existingImage">Hình hiện tại:</label>
                    <img id="existingImage" style="max-width: 100px; max-height: 100px;" alt="Hình hiện tại" value="">
                    <button onclick="removeExistingImage()" style="width:55px; height:auto;">Xoá</button>
                    <br> 
                    <label for="editProductImageInput">Chọn hình mới:</label>
                    <input type="file" name="image" id="image" accept="image/*">

                    <img id="selectedImage" style="max-width: 100px; max-height: 70px; " alt="Hình được chọn">
                </div>
                <button type="submit" style="width:55px; height:auto; margin-left:45%">Lưu</button>             
            </form>
        </div>
    </div>
        
       <div id="hoadon-content" class="content-section">
    <div class="headerad"> QUẢN LÝ HÓA ĐƠN</div>
   
    <div class="containbox">
        <label for="datestart">Ngày bắt đầu:</label>
        <input type="date" id="datestart1">
    </div>

    <div class="containbox">
        <label for="dateend">Ngày kết thúc:</label>
        <input type="date" id="dateend1">
    </div>

    <div class="containbox" style="display: flex; align-items: center;">
        <label for="transport" style="margin-right: 10px;">Loại vận chuyển:</label>
        <select id="transport" style="width: 100px;">
            <option value="">Chọn loại vận chuyển</option>
            <option value="Đang chờ duyệt">Đang chờ duyệt</option>
            <option value="Đã duyệt">Đã duyệt</option>
            <option value="Đang giao hàng">Đang giao hàng</option>
            <option value="Đã giao hàng">Đã giao hàng</option>
        </select>
    </div>
    
    <button type="submit" style="margin-top: 10px; margin-left: 10px" onclick="searchTransactionsByDate()">Tìm kiếm</button>
    <button type="submit" style="margin-top: 10px; margin-left: 10px" onclick=" window.location.reload()">Reset</button>

    <table id="hoadontable" border="1">
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
            <th>Change Transport</th>
        </tr>
<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';

$modelTransaction = new ModelTransaction();

// Lấy tất cả các giao dịch từ cơ sở dữ liệu"
$transactions = $modelTransaction->getAllTransactions();

// Kiểm tra xem có giao dịch nào không
if ($transactions) {
    foreach ($transactions as $transaction) {
?>
    <tr>
        <td><?php echo $transaction->getTransactionID(); ?></td>
        <td><?php echo $transaction->getUserID(); ?></td>
        <td><?php echo $transaction->getTotal(); ?></td>
        <td><?php echo $transaction->getNote(); ?></td>
        <td><?php echo $transaction->getTime(); ?></td>
        <td><?php echo $transaction->getAddress(); ?></td>
        <td><?php echo $transaction->getCheck(); ?></td>
        <td><?php echo $transaction->getTransport(); ?></td>
        <td><?php echo $transaction->getNameReceiver(); ?></td>
        <td><?php echo $transaction->getPhoneReceiver(); ?></td>
        <td><button onclick='showTransactionDetails(<?php echo $transaction->getTransactionID(); ?>)'>View Details</button></td>
        <td>
            <select id='status<?php echo $transaction->getTransactionID(); ?>'>
                <option value=''>Select Status</option>
                <option value='Đang chờ duyệt'>Đang chờ duyệt</option>
                <option value='Đã duyệt'>Đã duyệt</option>
                <option value='Đang giao hàng'>Đang giao hàng</option>
                <option value='Đã giao hàng'>Đã giao hàng</option>
            </select>
            <button onclick='changeTransactionStatus(<?php echo $transaction->getTransactionID(); ?>)'>Save</button>
        </td>
    </tr>
<?php
    }
}
?>
</table>

                

 <div id="popup" class="popup">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <div id="popup-details">
                <!-- Nội dung chi tiết hóa đơn sẽ được thêm bằng JavaScript -->
            </div>
        </div>
    </div>
        </div>

                

 <div id="popup" class="popup">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <div id="popup-details">
                <!-- Nội dung chi tiết hóa đơn sẽ được thêm bằng JavaScript -->
            </div>
        </div>
    </div>
        </div>
        <div id="dangxuat-content" class="content-section"></div>
    </div>

    </body>
</html>