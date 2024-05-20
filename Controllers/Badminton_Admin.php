<?php
session_start(); // Start the session at the beginning of the script
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../web_BadmintonStore/View/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../View/css/Badminton_Admin.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin</title>
    <style>
        .modal1 {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal1-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            margin: 20px auto;
        }

        .modal1-content div {
            margin-bottom: 10px;
        }

        #editUserForm input[type="text"],
        #editUserForm input[type="email"],
        #editUserForm input[type="number"],
        #editUserForm button[type="submit"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #editUserForm label {
            display: inline-block;
            width: 30%;
            margin-bottom: 5px;
        }

        #editUserForm div {
            display: grid;
            grid-template-columns: 30% 70%;/ gap: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            margin-top: -10px;
            margin-right: -10px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;

        }

        .product-version-container {
            display: flex;
            align-items: center;
        }

        .product-version {
            margin-right: 10px;
        }

        /* Tùy chỉnh kích thước của .tab-container */
        .tab-container {
            margin-top: 20px;
            /* Khoảng cách từ phía trên */
            max-width: 1000px;
            /* Chiều rộng tối đa */
            margin-right: auto;
            /* Căn giữa */
            width: 1000px;
        }

        /* Tùy chỉnh kích thước của tab navigation và nội dung tab */
        .nav-tabs .nav-item .nav-link {
            padding: 12px 20px;
            /* Kích thước padding của tab */
            font-size: 18px;
            /* Kích thước chữ của tab */
        }

        .tab-content {
            padding: 20px;
            /* Kích thước padding của nội dung tab */
            font-size: 16px;
            /* Kích thước chữ của nội dung tab */
        }

        .image-container {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .image-container img {
            max-width: 100px;
            max-height: 100px;
            display: block;
        }

        .image-container .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* CSS để tạo hiệu ứng cho popup modal */
        .modal-popup {
            display: none;
            position: fixed;
            z-index: 999;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content-popup {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 90%;
        }

        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script src="https://www.gstatic.com/firebasejs/9.21.0/firebase-app-compat.js"></script>

    <!-- Firebase Storage SDK -->
    <script src="https://www.gstatic.com/firebasejs/9.21.0/firebase-storage-compat.js"></script>

    <script>
        // Your web app's Firebase configuration
        var imgCurrent = null;
        var countIMG = 0;
        const firebaseConfig = {
            apiKey: "AIzaSyBsTkEPMoozdFG1qh--RQ1C-gyS9BVFh-w",
            authDomain: "badmintonstorage.firebaseapp.com",
            projectId: "badmintonstorage",
            storageBucket: "badmintonstorage.appspot.com",
            messagingSenderId: "994483053776",
            appId: "1:994483053776:web:de728e8975b81077bfead5",
            measurementId: "G-XWX5PKEHP8"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const storage = firebase.storage();

        async function getPromiseUrl(filePath) {
            if (filePath == "" || filePath == null) {
                alert('Please enter the file path');
                return;
            }

            try {
                const fileRef = storage.ref(filePath);
                const url = await fileRef.getDownloadURL();
                return url;
            } catch {
                console.error('Error getting file URL:', error);
                alert('Error getting file URL: ' + error.message);
                return "";
            }


        }
        /*
            function loadUrlImg(filePath) {
                var tmp;
                getPromiseUrl(filePath).then(url=>{
                    tmp = url;
                    console.log(tmp) ;
                }).catch(error=> {
                    return error;
                });
                return tmp;
            }*/

        function deleteFile(filePath) {
            // Create a reference to the file to delete
            const fileRef = storage.ref(filePath);

            // Delete the file
            fileRef.delete().then(() => {
                console.log('File deleted successfully');
                alert('File deleted successfully');
            }).catch((error) => {
                console.error('Error deleting file:', error);
                alert('Error deleting file: ' + error.message);
            });
        }
    </script>

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
        document.addEventListener('DOMContentLoaded', (event) => {
            const priceInput = document.getElementById('price');
            const discountInput = document.getElementById('discount');

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function handleInput(event) {
                let value = event.target.value.replace(/\./g, ''); // Remove existing dots
                if (!isNaN(value) && value !== "") {
                    event.target.value = formatNumber(value);
                }
            }

            priceInput.addEventListener('input', handleInput);

            priceInput.value = formatNumber(priceInput.value);
            discountInput.addEventListener('input', handleInput);

            discountInput.value = formatNumber(priceInput.value);
        });

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

        var myChart; // Declare the myChart variable outside the function

        function thongKe(event) {
            event.preventDefault(); // Prevent the default form behavior

            var startDate = document.getElementById('datestart2').value;
            var endDate = document.getElementById('dateend2').value;

            // Create an AJAX request to your PHP script
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../View/doanhso.php?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate), true);

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
    </script>
    <script>
        function showContent(contentId) {

            var contentSections = document.getElementsByClassName('content-section');
            for (var i = 0; i < contentSections.length; i++) {
                contentSections[i].style.display = 'none';
            }


            var selectedContent = document.getElementById(contentId);
            if (selectedContent)
                selectedContent.style.display = 'block';
        }

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
            xhr.open('GET', '../View/ViewDetail.php?transactionID=' + transactionID, true);
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
            xhr.open('GET', '../View/update_transaction_status.php?transactionID=' + encodeURIComponent(transactionID) + '&status=' + encodeURIComponent(newStatus), true);

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
            xhr.open('GET', `../View/search_transaction.php?startDate=${startDate}&endDate=${endDate}&transport=${transport}`, true);
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

        function changeUserStatus(userID, newStatus) {
            var xhr = new XMLHttpRequest();
            // Construct the URL with query parameters
            var url = "../View/change_user_status.php?userID=" + userID + "&newStatus=" + newStatus;
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
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

        function editUser(userID) {
            // Find the row that contains the user ID
            var rows = document.querySelectorAll('#taikhoan-content table tr');
            var userRow;

            for (var i = 1; i < rows.length; i++) { // start at 1 to skip the header row
                if (rows[i].children[0].textContent === userID) {
                    userRow = rows[i];
                    break;
                }
            }

            // Populate the form with user data
            if (userRow) {
                document.getElementById('editUserID').value = userID;
                document.getElementById('editUsername').value = userRow.children[1].textContent;
                document.getElementById('editName').value = userRow.children[2].textContent;
                document.getElementById('editEmail').value = userRow.children[3].textContent;
                document.getElementById('editPhoneNumber').value = userRow.children[4].textContent;
                document.getElementById('editPoint').value = userRow.children[5].textContent;
                document.getElementById('editRole').value = userRow.children[6].textContent;
                document.getElementById('editType').value = userRow.children[7].textContent;

                // Show the modal
                document.getElementById('editUserModal').style.display = 'block';
            } else {
                alert('User not found');
            }
        }

        function closeModal() {
            document.getElementById('editUserModal').style.display = 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function logout(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
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
            xhr.open('GET', 'Logout_admin.php', true);
            xhr.send();
        }



        function thongKeByBrand(event) {
            event.preventDefault(); // Prevent the default form behavior

            var startDate = document.getElementById('datestart2').value;
            var endDate = document.getElementById('dateend2').value;

            // Create an AJAX request to your new PHP script
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../View/doanhsotheohang.php?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate), true);

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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function logout(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
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
</head>

<body>
    <div>
        <div class="top_header">

        </div>
    </div>

    <div id="menu">
        <?php
        require_once '../Model/Entity/Permission.php'; // Include the Permission entity file
        require_once '../Model/ModelPermission.php'; // Include the ModelPermission class file
        require_once '../Model/ModelUser.php'; // Include the ModelUser class file

        // Function to check if functionID is allowed
        function isFunctionAllowed($functionID, $functionIDs)
        {
            return in_array($functionID, $functionIDs);
        }

        // Check if the session username is set
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            // Instantiate the ModelUser class
            $modelUser = new ModelUser();
            $user = $modelUser->getUserByUsername($username);

            if ($user !== null) {
                // Get the roleID from the User object
                $roleID = $user->getRoleID();

                // Instantiate the ModelPermission class
                $modelPermission = new ModelPermission();

                // Get permissions by roleID
                $permissions = $modelPermission->getPermissionsByRoleID($roleID);

                // Extract functionIDs from permissions
                $functionIDs = array_map(function ($permission) {
                    return $permission['functionID'];
                }, $permissions);
            } else {
                echo "User not found.";
                exit;
            }
        } else {
            echo "No username found in session.";
            exit;
        }
        ?>

        <ul>
            <li class="icon"><i class="fa-solid fa-house"></i><a href="#" onclick="saveCurrentContent('home-content'); showContent('home-content')">Trang chủ</a></li>
            <?php if (isFunctionAllowed(1, $functionIDs)) { ?>
                <li class="icon" id="phanquyen"><i class="fa-solid fa-people-roof"></i><a href="#" onclick="showContent('phanquyen-content')">Phân quyền</a></li>
            <?php } ?>
            <?php if (isFunctionAllowed(2, $functionIDs)) { ?>
                <li class="icon" id="taikhoan"><i class="fa-solid fa-user"></i><a href="#" onclick="saveCurrentContent('taikhoan-content'); showContent('taikhoan-content')">Quản lý tài khoản</a></li>
            <?php } ?>
            <?php if (isFunctionAllowed(3, $functionIDs)) { ?>
                <li class="icon" id="sanpham"><i class="fa-solid fa-laptop"></i><a href="#" onclick="saveCurrentContent('sanpham-content'); showContent('sanpham-content')">Quản lý sản phẩm</a></li>
            <?php } ?>
            <?php if (isFunctionAllowed(4, $functionIDs)) { ?>
                <li class="icon" id="loaisanpham"><i class="fa-solid fa-laptop"></i><a href="#" onclick="saveCurrentContent('loaisanpham-content'); showContent('loaisanpham-content')">Quản lý loại sản phẩm</a></li>
            <?php } ?>
            <?php if (isFunctionAllowed(5, $functionIDs)) { ?>
                <li class="icon" id="hoadon"><i class="fa-solid fa-receipt"></i><a href="#" onclick="saveCurrentContent('hoadon-content'); showContent('hoadon-content')">Quản lý hóa đơn</a></li>
            <?php } ?>
            <?php if (isFunctionAllowed(6, $functionIDs)) { ?>
                <li class="icon" id="doanhso"><i class="fa-solid fa-chart-simple"></i><a href="#" onclick="saveCurrentContent('doanhso-content'); showContent('doanhso-content')">Doanh số</a></li>
            <?php } ?>
            <li class="icon" id="dangxuat"><i class="fa-solid fa-right-from-bracket"></i><a href="#" onclick="logout(event)">Đăng xuất</a></li>
        </ul>
    </div>
    <div id="home-content" class="content-section">
        <div class="selling-products">
            <h1 class="text-center headerad">QUẢN LÝ CỬA HÀNG CẦU LÔNG</h1>
            <div class="item-selling-products" id="item-selling-products">



            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Quản lý nhóm quyền -->
    <div id="phanquyen-content" class="content-section">
        <h1 class="headerad">PHÂN QUYỀN</h1>
        <div class="tab-container">
            <div class="row">
                <div class="col-md-15 offset-md-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" onclick="openTab('tab1')" style="cursor: pointer;">Vai trò</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="openTab('tab2')" style="cursor: pointer;">Quyền</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <div id="tab1" class="tab-pane active">
                            <?php include('../View/user/pages/rolepage.php'); ?>
                        </div>
                        <div id="tab2" class="tab-pane" style="display: none;">
                            <?php include('../View/user/pages/grouprole.php'); ?>
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
                        <th>Role</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>";

            // Loop through each user and print their information
            foreach ($users as $user) {
                if ($user['status'] != 0) {
                    echo "<tr>
                    <td>" . $user['userID'] . "</td>
                    <td>" . $user['username'] . "</td>
                    <td>" . $user['name'] . "</td>
                    <td>" . $user['mail'] . "</td>
                    <td>" . $user['phoneNumber'] . "</td>
                    <td>" . $user['point'] . "</td>
                    <td>" . $user['roleID'] . "</td>
                    <td>" . $user['type'] . "</td>
                    <td><button onclick='changeUserStatus(\"" . $user['userID'] . "\", 0)'>Banned</button>
                    <button onclick='editUser(\"" . $user['userID'] . "\")'>Edit</button></td>
                </tr>";
                }
            }
            // Close the table tag
            echo "</table>";
        } else {
            // If there are no users, print a message
            echo "No users found.";
        }




        ?>
    </div>
    <div id="editUserModal" class="modal1">
        <div class="modal1-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" id="editUserID">
                <div>
                    <label for="editUsername">Username:</label>
                    <input type="text" id="editUsername" required>
                </div>
                <div>
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" required>
                </div>
                <div>
                    <label for="editEmail">Email:</label>
                    <input type="text" id="editEmail" required>
                </div>
                <div>
                    <label for="editPhoneNumber">Phone Number:</label>
                    <input type="text" id="editPhoneNumber" required>
                </div>
                <div>
                    <label for="editPoint">Point:</label>
                    <input type="text" id="editPoint" required>
                </div>
                <div>
                    <label for="editRole">Role:</label>
                    <input type="text" id="editRole" required>
                </div>
                <div>
                    <label for="editType">Type:</label>
                    <input type="text" id="editType" required>
                </div>
                <button type="submit">Save Changes</button>
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
        function addBrand($name, $description, $status)
        {
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
                echo "<script>window.location.href = 'Badminton_Admin.php';</script>"; // 



            } else {
                // Failed to add brand
                // You can redirect or show an error message here
                echo "<script>alert('Thêm loại sản phẩm thất bại');</script>";
                echo "<script>window.location.href = 'Badminton_Admin.php';</script>"; // 

            }
        }
        function deleteBrand($brandID)
        {
            $modelBrand = new ModelBrand();

            return $modelBrand->deleteBrand($brandID);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_brand']) && isset($_GET['brand_id'])) {
            $brandID = $_GET['brand_id'];


            $result = deleteBrand($brandID);

            if ($result) {

                echo "<script>alert('Xóa loại sản phẩm thành công!');</script>";
                echo "<script>window.location.href = 'Badminton_Admin.php';</script>";
            } else {
                // Failed to delete brand
                // You can redirect or show an error message here
                echo "<script>alert('Xóa loại sản phẩm thất bại');</script>";
                echo "<script>window.location.href = 'Badminton_Admin.php';</script>";
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
            <button type="submit" style="margin-top: 10px; margin-left: 10px;" onclick="thongKe(event);"> Thống kê doanh số </button>
            <button type="submit" style="margin-top: 10px; margin-left: 10px;" onclick="thongKeByBrand(event);"> Thống kê doanh số theo hãng </button>
            <h2 id="tongdoanhso"> </h2>
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
                require_once('../Model/ModelVariantDetail.php');
                require_once('../Model/ModelVariant.php');
                $ModelProduct = new ModelProduct();
                $products = $ModelProduct->getAllProducts();
                $ModelBrand = new ModelBrand();
                $brands = $ModelBrand->getAllBrands();
                $ModelCatalog = new ModelCatalog();
                $catalogs = $ModelCatalog->getAllCatalogs();
                $ModelVariantDetail = new ModelVariantDetail();
                $ModelVariant = new ModelVariant();
                if ($products) {
                    echo ' <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Mã sản phẩm</th>
                                    <th class="text-center" scope="col">Thương hiệu</th>
                                    <th class="text-center" scope="col">Danh mục</th>
                                    <th class="text-center" scope="col">Hình đại diện</th>
                                    <th class="text-center" scope="col">Sản phẩm</th>
                                    <th class="text-center" scope="col">Giá</th>
                                    <th class="text-center" scope="col">Giá gốc</th>
                                    <th class="text-center" scope="col">Trạng thái</th>
                                    <th class="text-center" scope="col">Thời gian tạo</th>
                                    <th class="text-center" scope="col">Chỉnh sửa</th>
                                </tr>
                            </thead>';
                    foreach ($products as $product) {
                        if ($product->status == 1) $status = "Đang bán";
                        else if ($product->status == -1) $status = "Đã xóa";
                        else $status = "Ngưng bán";
                        $listVariant = $ModelVariant->getListVariantByProductID($product->productID);
                        $catalogtmp = ($ModelCatalog->getCatalogByID($product->catalogID));
                        if ($catalogtmp->getName() == "Shuttle" || $catalogtmp->getName() == "String")
                            echo "
                                    <tbody>
                                    <tr>
                                        <td class='text-center'>{$product->productID}</td>
                                        <td class='text-center'>{$ModelBrand->getBrandByID($product->brandID)->getName()}</td>
                                        <td class='text-center'>{$ModelCatalog->getCatalogByID($product->catalogID)->getName()}</td>
                                        <td class='text-center'><img data-src='images/product/{$product->getProductID()}/default/{$product->getProductID()}.1.png' alt='Hình ảnh' id='image-{$product->getProductID()}' alt='" . $product->getName() . "' style='max-width: 100px; max-height: 100px;'></td>
                                        <td class='text-center'>{$product->name}</td>
                                        <td class='text-center'>" . number_format($product->price, 0, ',', '.') . " VNĐ</td>
                                        <td class='text-center'>" . number_format($product->fakePrice, 0, ',', '.') . " VNĐ</td>
                                        <td class='text-center'>{$status}</td>
                                        <td class='text-center'>{$product->timeCreated}</td>
                                        <td style='display:flex; justify-content:space-around; width: 150px'>
                                            <button id='openEditModal' data-productid={$product->productID}>Cập nhật</button>
                                            <button id='confirmDelete' data-productid={$product->productID}>Xoá</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                ";


                        else {
                            if (count($listVariant) > 0) {
                                $variantID = reset($listVariant)->getVariantID();
                                $variantDetail = $ModelVariantDetail->getVariantByID($variantID);
                                $color = $variantDetail->getColor();
                            } else {
                                $variantID = 0;
                                $variantDetail = 0;
                                $color = 0;
                            }


                            echo "
                                    
                                        <tbody>
                                        <tr>
                                            <td class='text-center'>{$product->productID}</td>
                                            <td class='text-center'>{$ModelBrand->getNameByID($product->brandID)}</td>
                                            <td class='text-center'>{$ModelCatalog->getCatalogByID($product->catalogID)->getName()}</td>
                                            <td class='text-center'><img data-src='images/product/" . $product->getProductID() . "/" . $color . "/" . $product->getProductID() . ".1.png' alt='Hình ảnh' id='image-{$product->getProductID()}' alt='" . $product->getName() . "' style='max-width: 100px; max-height: 100px;'></td>
                                            <td class='text-center'>{$product->name}</td>
                                            <td class='text-center'>" . number_format($product->price, 0, ',', '.') . " VNĐ</td>
                                            <td class='text-center'>" . number_format($product->fakePrice, 0, ',', '.') . " VNĐ</td>
                                            <td class='text-center'>{$status}</td>
                                            <td class='text-center'>{$product->timeCreated}</td>
                                            <td style='display:flex; justify-content:space-around; width: 150px'>
                                                <button id='openEditModal' data-productid={$product->productID}>Cập nhật</button>
                                                <button id='confirmDelete' data-productid={$product->productID}>Xoá</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    ";
                        }
                    }

                    echo "</table>";
                }
                ?>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const images = document.querySelectorAll('img[id^="image-"]');
                        images.forEach(image => {
                            var src = image.getAttribute("data-src");
                            getPromiseUrl(src).then(url => {
                                image.src = url;
                            }).catch(err => {
                                console.log(src);
                            });
                        });
                    });
                </script>

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
                        <label class="input-group-text" id="inputGroup-sizing-sm">Giá gốc</label>
                        <input type="text" name="discount" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <select name="status" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <label class="input-group-text" id="inputGroup-sizing-sm">Trạng thái</label>
                            <option selected>Trạng thái</option>
                            <option value="1">Đang bán</option>
                            <option value="0">Ngừng bán</option>
                            <option value="-1">Đã xóa</option>
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
                    let productName = row.querySelector('td:nth-child(5)').innerText;
                    let productPrice = row.querySelector('td:nth-child(6)').innerText;
                    let productDiscount = row.querySelector('td:nth-child(7)').innerText;
                    let productStatus = row.querySelector('td:nth-child(8)').innerText;
                    let productImageSrc = row.querySelector('td:nth-child(4) img').getAttribute('src');

                    // Gán giá trị cho các trường dữ liệu trong form

                    document.getElementById("productID").value = productID;
                    document.getElementById("name").value = productName;
                    document.getElementById("price").value = productPrice.replace(' VNĐ', '');
                    document.getElementById("discount").value = productDiscount.replace(' VNĐ', '');
                    document.getElementById('status').value = productStatus;
                    //document.getElementById("description").value = productDescription;
                    loadvariant(productID);


                });
            });

            function loadvariant(productID) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            var data = JSON.parse(this.responseText);
                            var keys = Object.keys(data);
                            var imagesrc = "images/product/" + productID + "/" + keys[0] + "/" + productID + ".1.png";
                            const uploadButton = document.getElementById('uploadButton');
                            uploadButton.setAttribute('data-color', keys[0]);
                            uploadButton.setAttribute('data-productID', productID);
                            // Fetch and set the main image
                            getPromiseUrl(imagesrc).then(url => {
                                document.getElementById("existingImage").setAttribute('src', url);
                            }).catch(error => {
                                console.error('Error fetching image URL:', error);
                            });

                            var imgUrl = data[keys[0]];
                            countIMG = imgUrl.length;
                            imgCurrent = imgUrl;
                            var imgContainer = document.getElementById('image-container');
                            imgContainer.innerHTML = '';

                            // Create promises for each image
                            var promises = imgUrl.slice(1).map((imgIndex, i) => {
                                let tmp = "images/product/" + productID + "/" + keys[0] + "/" + productID + "." + imgIndex + ".png";
                                return getPromiseUrl(tmp).then(url => {
                                    return `<div class="image-container">
                            <img src="` + url + `" alt="Image ` + (i + 1) + `" onclick="openImage(this.src)">
                            <button data-scr="` + tmp + `" data-id="` + productID + `" data-color="` + keys[0] + `" data-value="` + imgIndex + `" class="btn btn-danger delete-btn" onclick="deleteImage(this)">×</button>
                        </div>`;
                                }).catch(error => {
                                    console.error('Error fetching image URL:', error);
                                });
                            });

                            // Render all images once all promises are resolved
                            Promise.all(promises).then(results => {
                                imgContainer.innerHTML = results.join('');
                            });

                            var variantContainer = document.getElementById('variant');
                            variantContainer.innerHTML = '';

                            // Add radio buttons for variants
                            if (variantContainer.innerHTML.trim() === '') {
                                var firstRadio = true;
                                keys.forEach(function(key) {
                                    var uppercaseKey = key.toUpperCase();
                                    var radioHTML = `
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="color" id="${key}" value="${key}" data-value2="${productID}" onclick="loadvariantRadio(this)"`;

                                    if (firstRadio) {
                                        radioHTML += ` checked`;
                                        firstRadio = false;
                                    }

                                    radioHTML += `>
                                <label class="form-check-label" for="${key}">${uppercaseKey}</label>
                            </div>
                        `;

                                    variantContainer.innerHTML += radioHTML;
                                });
                            }
                        } else {
                            console.error("Yêu cầu thất bại");
                        }
                    }
                };
                xhttp.open("GET", "admin_product.php?get=listImg&productID=" + productID, true);
                xhttp.send();
            }



            function loadvariantRadio(c) {
                var productID = c.getAttribute('data-value2');
                var color = c.value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            var data = JSON.parse(this.responseText);
                            var keys = Object.keys(data);
                            const uploadButton = document.getElementById('uploadButton');
                            uploadButton.setAttribute('data-color', color);
                            uploadButton.setAttribute('data-productID', productID);
                            var imagesrc = "images/product/" + productID + "/" + color + "/" + productID + ".1.png";
                            getPromiseUrl(imagesrc).then(url => {
                                document.getElementById("existingImage").setAttribute('src', url);
                            }).catch(error => {
                                console.error('Error fetching image URL:', error);
                            });

                            var imgUrl = data[color];
                            imgCurrent = imgUrl;
                            countIMG = imgUrl.length;
                            var imgContainer = document.getElementById('image-container');
                            imgContainer.innerHTML = '';

                            var promises = imgUrl.map((imgIndex, i) => {
                                let tmp = "images/product/" + productID + "/" + color + "/" + productID + "." + imgIndex + ".png";
                                return getPromiseUrl(tmp).then(url => {
                                    return `<div class="image-container">
                            <img src="` + url + `" alt="Image ` + (i + 1) + `" onclick="openImage(this.src)">
                            <button data-color="` + color + `" data-id="` + productID + `" data-value="` + imgIndex + `" class="btn btn-danger delete-btn" onclick="deleteImage(this)">×</button>
                        </div>`;
                                }).catch(error => {
                                    console.error('Error fetching image URL:', error);
                                });
                            });

                            Promise.all(promises).then(results => {
                                imgContainer.innerHTML = results.join('');
                            });
                        } else {
                            console.error("Yêu cầu thất bại");
                        }
                    }
                };
                xhttp.open("GET", "admin_product.php?get=listImg&productID=" + productID, true);
                xhttp.send();
            }



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
                        window.location.href = '../View/Delete.php?productID=' + ProductID;
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

        <div id="editModal" class="modal" style="overflow-y: auto;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
            <form class="modal-content" action="../View/Update.php" method="POST" style="width: 50%; margin-left: 25%; margin-top: 3%; border: solid 2px; padding: 20px;">
                <span style="position: absolute; top: 5px; right: 5px;" class="close" onclick="closeEditModal()">&times;</span>
                <h1 style="text-align: center;">Chỉnh sửa sản phẩm</h1>

                <div class="input-group mb-3">
                    <span class="input-group-text" style="min-width: 120px;">Mã sản phẩm</span>
                    <input type="text" name="productID" id="productID" class="form-control" readonly>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" style="min-width: 120px;">Sản phẩm</span>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" style="min-width: 120px;">Giá</span>
                    <input name="price" id="price" class="form-control">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" style="min-width: 120px;">Giá gốc</span>
                    <input name="discount" id="discount" class="form-control">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" style="min-width: 120px;">Trạng thái</span>
                    <select name="status" id="status" class="form-select">
                        <option selected disabled>Chọn trạng thái</option>
                        <option value="Đang bán">Đang bán</option>
                        <option value="Ngừng bán">Ngừng bán</option>
                        <option value="Đã xóa">Đã xóa</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" style="min-width: 120px;">Mô tả</span>
                    <input type="text" name="description" id="description" class="form-control">
                </div>

                <div class="input-group mb-3" id="variant">

                </div>
                <div class="input-group mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-version-container">
                                    <div class="product-version">Biến thể:</div>
                                    <div class="position-relative d-inline-block badge-container" style="margin-left: 20px; cursor:pointer;">
                                        <div class="badge badge-primary" style="height: 40px; width:100px; line-height: 30px" data-toggle="badge">4UG5
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute" style="top: -10px; right: -15px;" data-toggle="button">&times;</button>
                                        </div>
                                    </div>
                                    <div class="position-relative d-inline-block badge-container" style="margin-left: 20px; cursor:pointer;">
                                        <div class="badge badge-primary" style="height: 40px; width:100px; line-height: 30px" data-toggle="badge">4UG5
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute" style="top: -10px; right: -15px;" data-toggle="button">&times;</button>
                                        </div>
                                    </div>
                                    <div class="position-relative d-inline-block badge-container" style="margin-left: 20px; cursor:pointer;">
                                        <div class="badge badge-primary" style="height: 40px; width:100px; line-height: 30px" data-toggle="badge">4UG5
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute" style="top: -10px; right: -15px;" data-toggle="button">&times;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Lắng nghe sự kiện nhấp vào badge
                            document.querySelectorAll('[data-toggle="badge"]').forEach(function(badge) {
                                badge.addEventListener('click', function() {
                                    // Loại bỏ lớp "badge-active" từ tất cả các badge
                                    document.querySelectorAll('.badge-container').forEach(function(item) {
                                        item.classList.remove('badge-active');
                                    });
                                    // Thêm lớp "badge-active" cho badge được nhấp vào
                                    badge.closest('.badge-container').classList.add('badge-active');
                                });
                            });

                            // Lắng nghe sự kiện nhấp vào nút xóa
                            document.querySelectorAll('[data-toggle="button"]').forEach(function(button) {
                                button.addEventListener('click', function(event) {
                                    event.stopPropagation(); // Ngăn chặn sự kiện click trên badge
                                });
                            });
                        </script>

                        <!-- Thêm hàng mới cho input và nút lưu -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group" style="margin-top: 10px; width:60%">
                                    <input type="text" class="form-control" placeholder="Số lượng" aria-label="Số lượng" aria-describedby="basic-addon2">
                                    <div class="input-group-append" style="width: 100px">
                                        <button class="btn btn-outline-secondary" type="button">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="input-group mb-3">
                    <label for="existingImage">Ảnh đại diện:</label>
                    <div class="d-flex align-items-center">
                        <img id="existingImage" style="max-width: 100px; max-height: 100px;" alt="Hình hiện tại" value="">
                        <button class="btn btn-success ms-3" onclick="removeExistingImage()">Đổi</button>
                    </div>
                </div>
                <label>Ảnh chi tiết:</label>
                <div class="container mt-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap" id="image-container">
                                <div class="image-container">
                                    <img src="../View/images/product/1/Kurenai/1.1.png" alt="Image 1" onclick="openImage(this.src)">
                                    <button class="btn btn-danger delete-btn">&times;</button>
                                </div>
                                <div class="image-container">
                                    <img src="../View/images/product/1/Kurenai/1.2.png" alt="Image 2" onclick="openImage(this.src)">
                                    <button class="btn btn-danger delete-btn">&times;</button>
                                </div>
                                <div class="image-container">
                                    <img src="../View/images/product/1/Kurenai/1.3.png" alt="Image 3" onclick="openImage(this.src)">
                                    <button class="btn btn-danger delete-btn">&times;</button>
                                </div>
                                <!-- Add more images as needed -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popup Modal -->
                <div id="imageModal" class="modal-popup">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <img class="modal-content-popup" id="modalImage">
                </div>
                <script>
                    function deleteImage(button) {
                        var deleteImageConfirmation = window.confirm("Bạn có muốn xoá ảnh này?");
                        if (deleteImageConfirmation) {
                            var imageContainer = button.parentElement; // Lấy phần tử cha của nút (div .image-container)
                            imageContainer.remove();
                            var productID = button.getAttribute('data-id');
                            var imgIndex = button.getAttribute('data-value');
                            var color = button.getAttribute('data-color');
                            var imgSrc = button.getAttribute('data-scr'); // Get the image src from data attribute

                            // Call the deleteFile function with the image path


                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4) {
                                    if (this.status == 200) {
                                        var data = JSON.parse(this.responseText);
                                        deleteFile(imgSrc);
                                        console.log(data);
                                    } else {
                                        console.error("Yêu cầu thất bại");
                                    }
                                }
                            };
                            xhttp.open("GET", "admin_product.php?get=delImg&productID=" + productID + "&imgDel=" + imgIndex + "&color=" + color, true);
                            xhttp.send();
                        }
                    }


                    function openImage(src) {
                        var modal = document.getElementById('imageModal');
                        var modalImg = document.getElementById('modalImage');
                        modal.style.display = "block";
                        modalImg.src = src;
                    }

                    function closeModal() {
                        var modal = document.getElementById('imageModal');
                        modal.style.display = "none";
                    }
                </script>


                <div class="input-group mb-3">
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Thêm hình chi tiết</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="image-choose" class="form-label">Chọn hình mới:</label>
                                    <input type="file" class="form-control" id="image-choose" accept="image/*" multiple>
                                </div>
                                <div id="selectedImages" class="d-flex flex-wrap gap-2">
                                    <!-- Hình được chọn sẽ hiển thị ở đây -->
                                </div>
                                <button id="uploadButton" class="btn btn-primary mt-3">Upload Image</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('image-choose').addEventListener('change', function(event) {
                        const files = event.target.files;
                        const selectedImagesContainer = document.getElementById('selectedImages');
                        selectedImagesContainer.innerHTML = ''; // Clear any previous images

                        Array.from(files).forEach(file => {
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.style.maxWidth = '150px';
                                    img.style.maxHeight = '150px';
                                    img.style.border = 'solid 1px #007bff';
                                    selectedImagesContainer.appendChild(img);
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    });

                    document.getElementById('uploadButton').addEventListener('click', function() {
                        event.preventDefault();
                        const files = document.getElementById('image-choose').files;
                        const uploadButton = document.getElementById('uploadButton');
                        var color = uploadButton.getAttribute("data-color");
                        var productID = uploadButton.getAttribute("data-productID");
                        if (files.length === 0) {
                            alert('No files selected');
                            return;
                        }

                        Array.from(files).forEach(file => {
                            convertAndUpload(file, productID, color);
                        });
                    });

                    function convertUrlToLocalPath(url) {
                        // Tách phần query parameters từ URL
                        const [pathPart] = url.split('?');
                        // Thay thế các ký tự đặc biệt và các phần tử dấu '%2F' thành '/'
                        const localPath = pathPart.replace(/%2F/g, '/').replace(/%20/g, ' ');
                        const regex = /\.([0-9]+)\.png$/;
                        const match = localPath.match(regex);

                        if (match && match[1]) {
                            return match[1];
                        } else {
                            console.error('No timestamp found in the URL.');
                            return null;
                        }

                    }
                    let imageURLs = [];

                    function convertAndUpload(file, productID, color) {
    return new Promise((resolve, reject) => {
        // Tạo đối tượng FileReader để đọc tệp hình ảnh
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(event) {
            const imgElement = document.createElement('img');
            imgElement.src = event.target.result;

            imgElement.onload = function() {
                // Tạo canvas để chuyển đổi hình ảnh
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = imgElement.width;
                canvas.height = imgElement.height;
                ctx.drawImage(imgElement, 0, 0);

                // Chuyển đổi hình ảnh thành định dạng PNG
                canvas.toBlob(function(blob) {
                    const filePath = 'images/product/' + productID + '/' + color + '/' + productID + '.' + Date.now() + ".png";
                    const storageRef = storage.ref(filePath);

                    // Tải lên tệp đã chuyển đổi
                    const uploadTask = storageRef.put(blob);

                    uploadTask.on('state_changed',
                        (snapshot) => {
                            // Quan sát trạng thái thay đổi
                            const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                            console.log('Upload is ' + progress + '% done');
                        },
                        (error) => {
                            // Xử lý lỗi
                            console.error('Upload failed:', error);
                            reject(error);
                        },
                        () => {
                            // Lấy URL của ảnh đã tải lên
                            uploadTask.snapshot.ref.getDownloadURL().then((downloadURL) => {
                                console.log('File available at', downloadURL);

                                // Thêm đường dẫn vào mảng imageURLs
                                const localPath = convertUrlToLocalPath(downloadURL);
                                imageURLs.push(localPath);
                                console.log('Array of image URLs:', imageURLs);
                                resolve(localPath);
                            }).catch(reject);
                        }
                    );
                }, 'image/png');
            };
        };
        reader.onerror = reject;
    });
}

async function uploadFiles(files, productID, color) {
    try {
        for (const file of files) {
            await convertAndUpload(file, productID, color);
        }

        // Chuyển đổi mảng imageURLs thành chuỗi JSON và mã hóa nó
        const imageURLsJson = encodeURIComponent(JSON.stringify(imageURLs));

        // Tạo và gửi yêu cầu XMLHttpRequest
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    console.log(data);
                } else {
                    console.error("Yêu cầu thất bại");
                }
            }
        };

        xhttp.open("GET", "admin_product.php?get=addImg&productID=" + productID + "&color=" + color + "&imageURLs=" + imageURLsJson, true);
        xhttp.send();
    } catch (error) {
        console.error("Error during upload:", error);
    }
}
                </script>



                <button type="submit" class="btn btn-primary" style="width:100%;">Lưu</button>
                <script>
                    function saveUpdateProduct() {
                        var name = document.getElementById('name').innerText;
                        var price = document.getElementById('price').innerText;
                        var fakePrice = document.getElementById('discount').innerText;
                        console.log(fakePrice);
                    }
                </script>
            </form>

        </div>
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
    <div id="dangxuat-content" class="content-section"></div>
    </div>
    <script>
        function openTab(tabName) {
            // Lấy danh sách tất cả các tab và tablinks
            var tabs = document.querySelectorAll('.tab-pane');
            var tabLinks = document.querySelectorAll('.nav-link');

            // Ẩn tất cả các tab trước khi hiển thị tab được chọn
            tabs.forEach(function(tab) {
                tab.style.display = 'none';
            });

            // Loại bỏ lớp 'active' cho tất cả các tablinks trước khi chọn tab mới
            tabLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Hiển thị tab được chọn và thêm lớp 'active' cho tablink tương ứng
            document.getElementById(tabName).style.display = 'block';
            document.querySelector('a[onclick="openTab(\'' + tabName + '\')"]').classList.add('active');
        }
    </script>


    <?php
    if (isset($_GET['message'])) {
        if ($_GET['message'] == 'success') {
            echo "<script>alert('Cập nhật thành công!');</script>";
        } elseif ($_GET['message'] == 'error') {
            echo "<script>alert('Cập nhật thất bại.');</script>";
        } elseif ($_GET['message'] == 'missing') {
            echo "<script>alert('Lỗi: Thiếu thông tin cần thiết.');</script>";
        }
    }
    ?>

</body>
<script>
    document.getElementById('editUserForm').onsubmit = function(event) {
        event.preventDefault();

        var userID = document.getElementById('editUserID').value;
        var username = document.getElementById('editUsername').value;
        var name = document.getElementById('editName').value;
        var email = document.getElementById('editEmail').value;
        var phoneNumber = document.getElementById('editPhoneNumber').value;
        var point = document.getElementById('editPoint').value;
        var role = document.getElementById('editRole').value;
        var type = document.getElementById('editType').value;

        // AJAX request to update user info
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `updateUser.php?userID=${userID}&username=${username}&name=${name}&email=${email}&phoneNumber=${phoneNumber}&point=${point}&role=${role}&type=${type}`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle response from the server
                alert('Cập nhật tài khoản thành công');
                closeModal();
                window.location.reload();
            }
        };
        xhr.send();
    };
</script>

</html>