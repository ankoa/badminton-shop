<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View//bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../View/css/Badminton_Admin.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin</title>
    <style>
    /* Style for the modal form */
    #editRoleForm {
        position: fixed;
        top: 50%;
        left: 50%;
        /* transform: translate(-50%, -40%);  */
        width: 100%;
        max-width: 100%;
        height: 95%;
    }
    #Role-background {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(87, 84, 84, .4);
        z-index: 10005;
        align-items: center;
        justify-content: center;
    }
    .Role {
        background-color: #fff;
        border-radius: 10px;
        padding: 2.5rem; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 75%; 
        max-width: 50rem; 
        height: 75%;
    }
    .closeformrole {
        cursor: pointer;
        position: absolute;
        right: 4%;
        top: 4%;
        width: 48px;
        height: 48px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 35px;
        font-weight: 500;
    }
    .rowfunction{
        margin-bottom: 10px;
    }
    .long-label {
        min-width: 150px; /* Đặt kích thước tối thiểu cho nhãn */
        display: inline-block; /* Cho phép nhãn mở rộng theo nội dung */
        margin-right: 40px;
        margin-top: 2px;
    }
    .long-label1 {
        min-width: 150px; /* Đặt kích thước tối thiểu cho nhãn */
        display: inline-block; /* Cho phép nhãn mở rộng theo nội dung */
        margin-right: 15px;
        margin-top: 2px;
    }

</style>
</head>
<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Tạo một đối tượng ModelTransaction và gọi hàm displayTotalSales
    $modelTransaction = new ModelTransaction();
    $modelTransaction->displayTotalSales($startDate, $endDate);
}
?>

<!-- Script JavaScript -->
<script>
    function openPermissionForm() {
        var form = document.getElementById('permissionForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    function addPermissions() {
        // Xử lý thêm quyền vào nhóm quyền tương ứng
        // Sử dụng AJAX để gửi dữ liệu form lên server và xử lý dữ liệu ở phía server
        return false; // Để ngăn form submit mặc định
    }

    function editXuLy(roleID) {
        var form = document.getElementById('permissionForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            form.style.zIndex = 1000;
        } else {
            form.style.display = 'none';
        }
    }
</script>
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
function changeTransactionStatus(transactionID, currentStatus) {
    // Xác định trạng thái mới dựa trên trạng thái hiện tại
    var newStatus = '';
    if (currentStatus === 'Chờ duyệt') {
        newStatus = 'Đã duyệt';
    } else {
        newStatus = 'Chờ duyệt';
    }

    // Tạo một yêu cầu AJAX để cập nhật trạng thái
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_transaction_status.php?transactionID=' + encodeURIComponent(transactionID) + '&status=' + encodeURIComponent(newStatus), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            console.log(response);
            if (response === 'success') {
                alert('Cập nhật trạng thái thành công!');
                window.location.reload();
            } else {
                alert('Cập nhật trạng thái thất bại!');
            }
        }
    };

    // Gửi yêu cầu
    xhr.send();
}



var myChart; // Khai báo biến myChart ở ngoài hàm

function thongKe(event) {
    event.preventDefault(); // Prevent the default form behavior

    var startDate = document.getElementById('datestart2').value;
    var endDate = document.getElementById('dateend2').value;

    // Create an AJAX request to your PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'doanhso.php?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate), true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log
            var salesData = JSON.parse(this.responseText);

            // Get the canvas element where the chart will be drawn
            var ctx = document.getElementById('salesChart').getContext('2d');
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

            // Populate the table with sales data
            for (var i = 0; i < salesData.labels.length; i++) {
                var row = table.insertRow(-1); // Insert a new row at the end of the table
                var cell1 = row.insertCell(0); // Insert a new cell in the row
                var cell2 = row.insertCell(1); // Insert a new cell in the row
            
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
            if (xhr.readyState == 4 && xhr.status == 200) {
                var salesData = JSON.parse(this.responseText);

                // Get the canvas element where the chart will be drawn
                var ctx = document.getElementById('salesChart').getContext('2d');
                // Destroy the old chart if they exist
                if (myChart) {
                    myChart.destroy();
                }

                // Check if there is no sales data
                if (salesData.labels.length === 0) {
                alert('Không có doanh thu để hiển thị');
                    return;
                } else {
    
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

                // Create the chart using the existing myChart variable
                myChart = new Chart(ctx, {
                    type: 'bar', // Change this to 'bar' to better represent sales by brand
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
                    cell1.innerHTML = salesData.labels[i]; // This will now be brand ID
                    cell2.innerHTML = salesData.totalSales[i]; // This will now be total sales for the brand
                }
            }
        };

        // Send the request
        xhr.send();
    }



    </script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>
    <div>
        <div class="top_header">

        </div>
    </div>

    <div id="menu">
        <ul>
            <li class="icon"><i class="fa-solid fa-house"></i><a href="#" onclick="showContent('home-content')">Trang chủ </a></li>
            <li class="icon" id="phanquyen"><i class="fa-solid fa-people-roof"></i><a href="#" onclick="showContent('phanquyen-content')">Phân quyền</a></li>
            <li class="icon" id="taikhoan"><i class="fa-solid fa-user"></i><a href="#" onclick="showContent('taikhoan-content')">Quản lý tài khoản</a></li>
            <li class="icon" id="doanhso"><i class="fa-solid fa-chart-simple"></i><a href="#" onclick="showContent('doanhso-content')">Doanh số</a></li>
            <li class="icon" id="sanpham"><i class="fa-solid fa-laptop"></i><a href="#" onclick="showContent('sanpham-content')">Quản lý sản phẩm</a></li>
            <li class="icon" id="hoadon"><i class="fa-solid fa-receipt"></i><a href="#" onclick="showContent('hoadon-content')">Quản lý hóa đơn</a></li>
            <li class="icon" id="dangxuat"><i class="fa-solid fa-right-from-bracket"></i><a href="#" onclick="logout(event)">Đăng xuất</a></li>

<script>
function logout(event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Xử lý phản hồi từ server
                var response = JSON.parse(xhr.responseText);
                if (response.status === 1) {
                    // Đăng xuất thành công, chuyển hướng người dùng
                    window.location.href = 'index.php'; 
                } else {
                    alert('Đăng xuất không thành công!');
                }
            } else {
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        }
    };
    xhr.open('GET', 'Logout_admin.php', true); // Tạo một file logout.php để xử lý đăng xuất
    xhr.send();
}

</script>

        </ul>
    </div>
    <div id="home-content" class="content-section">
        <div class="selling-products">
            <h1 class="text-center headerad">QUẢN LÝ CỬA HÀNG CẦU LÔNG</h1>
            <div class="item-selling-products" id="item-selling-products">
            </div>
        </div>
    </div>

    <script>
    function closeEditRoleForm() {
        var editRoleForm = document.getElementById("editRoleForm");
        editRoleForm.style.display = "none";
    }
</script>
<!-- Quản lý nhóm quyền -->
<div id="phanquyen-content" class="content-section">
    <h1 class="headerad">PHÂN QUYỀN</h1>
    <div>
        <div class="col-md-4">
            <label style="margin-right: 10px;">Danh sách nhóm quyền</label>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addModal" style="width: 100px; padding: 6px;">
                Thêm mới
            </button>
        </div>

        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-striped" id="quanlyPQTable" style="text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Mã nhóm quyền</th>
                        <th scope="col" class="text-center">Tên nhóm quyền</th>
                        <th scope="col" class="text-center">Số lượng người dùng</th>
                        <th scope="col" class="text-center">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '../../Model/ModelRole.php';
                    require_once __DIR__ . '../../Model/ModelUser.php';

                    $modelRole = new ModelRole();
                    $modelUser = new ModelUser();

                    $roles = $modelRole->getAllRoles();

                    if ($roles) {
                        foreach ($roles as $role) {
                            echo '<tr style="height: 50px;">';
                            echo "<td class=\"text-center\">" . $role['roleID'] . "</td>";
                            echo "<td class=\"text-center\">" . $role['roleName'] . "</td>";
                    
                            // Lấy số lượng người dùng cho từng nhóm quyền
                            $userCount = $modelUser->getUserCountByRoleID($role['roleID']);
                            echo "<td class=\"text-center\">" . $userCount . "</td>";
                    
                            echo '<td class="d-flex justify-content-evenly">';
                            echo '<i class="fas fa-wrench" style="font-size: 25px; color: orange;" onclick="showEditForm(' . $role['roleID'] . ')"></i>';
                            echo '</td>';

                    
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function showEditForm(roleID){
        var form = document.getElementById("editRoleForm");
        form.style.display = "block";
        $.ajax({
            url: '../Controllers/process_edit_form.php',
            type: 'GET',
            data: $(this).serializeArray(),
            success: function(response) {
                var data = JSON.parse(response);
                for (var i = 0; i < data.length; i++) {
                    var item = data[i];
                    if (item.roleID.trim()+"" == roleID+"" && item.functionID.trim()+"" == 1) {
                        console.log("Matching roleID and functionID found.");
                        console.log(item.permissionName);
                        switch (item.permissionName) {
                            case "show":
                                console.log("Setting showAccountSwitch to default checked.");
                                setDefaultCheckedStatus("showAccountSwitch");
                                break;
                            case "add":
                                console.log("Setting addAccountSwitch to default checked.");
                                setDefaultCheckedStatus("addAccountSwitch");
                                break;
                            case "update":
                                console.log("Setting updateAccountSwitch to default checked.");
                                setDefaultCheckedStatus("updateAccountSwitch");
                                break;
                            case "delete":
                                console.log("Setting deleteAccountSwitch to default checked.");
                                setDefaultCheckedStatus("deleteAccountSwitch");
                                break;
                            default:
                                console.log("No matching permission found.");
                                break;
                        }
                    }
                    if (item.roleID.trim()+"" == roleID+"" && item.functionID.trim()+"" == 2) {
                        console.log("Matching roleID and functionID found.");
                        console.log(item.permissionName);
                        switch (item.permissionName) {
                            case "show":
                                setDefaultCheckedStatus("showProductSwitch");
                                break;
                            case "add":
                                setDefaultCheckedStatus("addProductSwitch");
                                break;
                            case "update":
                                setDefaultCheckedStatus("updateProductSwitch");
                                break;
                            case "delete":
                                setDefaultCheckedStatus("deleteProductSwitch");
                                break;
                            default:
                                console.log("No matching permission found.");
                                break;
                        }
                    }
                    if (item.roleID.trim()+"" == roleID+"" && item.functionID.trim()+"" == 3) {
                        console.log("Matching roleID and functionID found.");
                        console.log(item.permissionName);
                        switch (item.permissionName) {
                            case "show":
                                console.log("Setting showAccountSwitch to default checked.");
                                setDefaultCheckedStatus("showInvoiceSwitch");
                                break;
                            case "add":
                                console.log("Setting addInvoiceSwitch to default checked.");
                                setDefaultCheckedStatus("addInvoiceSwitch");
                                break;
                            case "update":
                                console.log("Setting updateInvoiceSwitch to default checked.");
                                setDefaultCheckedStatus("updateInvoiceSwitch");
                                break;
                            case "delete":
                                console.log("Setting deleteInvoiceSwitch to default checked.");
                                setDefaultCheckedStatus("deleteInvoiceSwitch");
                                break;
                            default:
                                console.log("No matching permission found.");
                                break;
                        }
                    } else {
                        console.log("No matching roleID and functionID.");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(error); // Xử lý lỗi nếu có
            }
        });
    }
</script>
<script>
    function setDefaultCheckedStatus(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        if (checkbox) {
            checkbox.checked = true; // Đặt trạng thái checked cho checkbox
        }
    }
</script>

<div id="editRoleForm" style="display: none;">
    <div id="Role-background">
    <div class="Role">
    <a class="closeformrole" onclick="closeEditRoleForm()">
          <i class="fa-solid fa-xmark"></i></a>
  <div class="container mt-5">
  <div class="row">
      <div class="col-md-3"></div> <!-- Thêm cột trống ở bên trái -->
      <div class="col-md-6 text-center"> <!-- Cột chứa nhãn "Nhóm quyền" -->
        <h3 class="mb-4">Nhóm quyền</h3>
      </div>
      <div class="col-md-3"></div> <!-- Thêm cột trống ở bên phải -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Form để chứa các thành phần quản lý -->
        <form id="managementForm">
    <div class="form-row align-items-center">
        <!-- Quản lý Quyền -->
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="RoleManagement">Quyền:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showRoleSwitch">
                <label class="form-check-label" for="showRoleSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addRoleSwitch">
                <label class="form-check-label" for="addRoleSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateRoleSwitch">
                <label class="form-check-label" for="updateRoleSwitch">Sửa</label>
            </div>
        </div>
            <div class="col-md-2">
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="deleteRoleSwitch">
                    <label class="form-check-label" for="deleteRoleSwitch">Xóa</label>
                </div>
            </div>
    </div>

    <!-- Quản lý Tài khoản -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="AccountManagement">Tài khoản:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showAccountSwitch">
                <label class="form-check-label" for="showAccountSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addAccountSwitch">
                <label class="form-check-label" for="addAccountSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateAccountSwitch">
                <label class="form-check-label" for="updateAccountSwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteAccountSwitch">
                <label class="form-check-label" for="deleteAccountSwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý sản phẩm -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="productManagement">Sản phẩm:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3" >
                <input class="form-check-input" type="checkbox" id="showProductSwitch">
                <label class="form-check-label" for="showProductSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addProductSwitch">
                <label class="form-check-label" for="addProductSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateProductSwitch">
                <label class="form-check-label" for="updateProductSwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteProductSwitch">
                <label class="form-check-label" for="deleteProductSwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý loại sản phẩm -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3.1">
            <label class="form-check-label text-left long-label1" for="categoryManagement">Loại sản phẩm:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showCategorySwitch">
                <label class="form-check-label" for="showCategorySwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addCategorySwitch">
                <label class="form-check-label" for="addCategorySwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateCategorySwitch">
                <label class="form-check-label" for="updateCategorySwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteCategorySwitch">
                <label class="form-check-label" for="deleteCategorySwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý hóa đơn -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="invoiceManagement">Hóa đơn:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="showInvoiceSwitch">
                <label class="form-check-label" for="showInvoiceSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="addInvoiceSwitch">
                <label class="form-check-label" for="addInvoiceSwitch">Thêm</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="updateInvoiceSwitch">
                <label class="form-check-label" for="updateInvoiceSwitch">Sửa</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="deleteInvoiceSwitch">
                <label class="form-check-label" for="deleteInvoiceSwitch">Xóa</label>
            </div>
        </div>
    </div>

    <!-- Các thành phần quản lý doanh thu -->
    <div class="form-row align-items-center mt-3">
        <div class="col-md-3">
            <label class="form-check-label text-left long-label" for="revenueManagement">Doanh thu:</label>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="viewRevenueSwitch">
                <label class="form-check-label" for="viewRevenueSwitch">Xem</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="exportRevenueSwitch">
                <label class="form-check-label" for="exportRevenueSwitch">Xuất</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="analyzeRevenueSwitch">
                <label class="form-check-label" for="analyzeRevenueSwitch">Phân tích</label>
            </div>
        </div>
        <div class="col-md-2"></div> <!-- Ô trống -->
    </div>

    <!-- Nút Lưu -->
    <button type="submit" class="btn btn-primary mt-4">Lưu</button>
</form>


        <!-- Kết thúc form -->
      </div>
    </div>
    </div>
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


        // Check if there are any users
        if ($users) {
            // Print table header
            echo "<table border='1'>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Point</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>";

            // Loop through each user and print their information
            foreach ($users as $user) {
                echo "<tr>
                    <td>" . $user['userID'] . "</td>
                    <td>" . $user['username'] . "</td>
                    <td>" . $user['name'] . "</td>
                    <td>" . $user['mail'] . "</td>
                    <td>" . $user['phoneNumber'] . "</td>
                    <td>" . $user['point'] . "</td>
                    <td>" . $user['type'] . "</td>
                    <td>" . $user['status'] . "</td>
                    <td><button onclick='editUser(\"" . $user['userID'] . "\")'>Edit</button></td>
                </tr>";
            }

            // Close the table tag
            echo "</table>";
        } else {
            // If there are no users, print a message
            echo "No users found.";
        }




    ?>
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
                        <th>Ngày</th>
                        <th>Doanh số thu được</th>
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
                    <input type="date" id="dateend1x">
                </div>

        <?php
    
require_once __DIR__ . '../../Model/ModelTransaction.php';

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
                <th>Total</th>
                <th>Note</th>
                <th>Time</th>
                <th>Address</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>";

    // Duyệt qua từng giao dịch và in ra thông tin
    foreach ($transactions as $transaction) {
        $transactionObj = new Transaction(
            $transaction['transactionID'],
            $transaction['userID'],
            $transaction['total'],
            $transaction['note'],
            $transaction['time'],
            $transaction['address'],
            $transaction['pay'],
            $transaction['transport']
        );
        echo "<tr>
        <td>" . $transactionObj->getTransactionID() . "</td>
        <td>" . $transactionObj->getTotal() . "</td>
        <td>" . $transactionObj->getNote() . "</td>
        <td>" . $transactionObj->getTime() . "</td>
        <td>" . $transactionObj->getAddress() . "</td>
        <td>" . $transactionObj->getTransport() . "</td>
        <td><button onclick='showTransactionDetails(\"" . $transactionObj->getTransactionID() . "\")'>Chi tiết</button></td>
        <td><button onclick='changeTransactionStatus(\"" . $transactionObj->getTransactionID() . "\", \"" . $transactionObj->getTransport() . "\")'>Chuyển trạng thái</button></td>;

    </tr>";
    


    }

    echo "</table>";
} else {
    echo "Không có giao dịch nào.";
}
?>
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
