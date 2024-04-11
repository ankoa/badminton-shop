<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../View/css/Badminton_Admin.css">
    <title>Admin</title>
</head>
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
</script>

<body>
    <div>
        <div class="top_header">

        </div>
    </div>

    <div id="menu">
        <ul>
            <li class="icon"><i class="fa-solid fa-house"></i><a href="#" onclick="showContent('home-content')">Trang chủ </a></li>
            <li class="icon" id="taikhoan"><i class="fa-solid fa-user"></i><a href="#" onclick="showContent('taikhoan-content')">Quản lý tài khoản</a></li>
            <li class="icon" id="doanhso"><i class="fa-solid fa-chart-simple"></i><a href="#" onclick="showContent('doanhso-content')">Doanh số</a></li>
            <li class="icon" id="sanpham"><i class="fa-solid fa-laptop"></i><a href="#" onclick="showContent('sanpham-content')">Quản lý sản phẩm</a></li>
            <li class="icon" id="hoadon"><i class="fa-solid fa-receipt"></i><a href="#" onclick="showContent('hoadon-content')">Quản lý hóa đơn</a></li>
            <li class="icon" id="dangxuat"><i class="fa-solid fa-right-from-bracket"></i><a href="#" onclick="logout()">Đăng xuất</a></li>

        </ul>
    </div>
    <div id="home-content" class="content-section">
        <div class="selling-products">
            <h1 class="text-center headerad">QUẢN LÝ CỬA HÀNG CẦU LÔNG</h1>
            <div class="item-selling-products" id="item-selling-products">
            </div>
        </div>
    </div>




    <!-- Quản lý tài khoản -->
    <div id="taikhoan-content" class="content-section">
        <h1 class="headerad">QUẢN LÝ TÀI KHOẢN</h1>
        <table class="tabletk" id="quanlytkTable" cellpadding="50" cellspacing="100">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Ngày đăng ký</th>
                    <th>Quyền</th>
                    <th>Xóa</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="doanhso-content" class="content-section">




        <!-- Quản lý doanh số -->
        <h1 style="padding-left: 10%;"> TÌM KIẾM THEO NGÀY</h1>
        <table class="tabledoanhso" id="quanlydoanhso" cellpadding="50" cellspacing="100">
            <thead>
                <tr>
                    <th>Hãng</th>
                    <th>Số lượng bán</th>
                    <th>Doanh số thu được</th>
                </tr>
            </thead>
        </table>
        <form id="frmdoanhso">
            <div class="containbox">
                <label for="datestart">Ngày bắt đầu:</label>
                <input type="date" id="datestart2">
            </div>
            <div class="containbox">
                <label for="dateend">Ngày kết thúc:</label>
                <input type="date" id="dateend2">
            </div>
            <button type="submit" style="margin-top: 10px; margin-left: 10px;" onclick="thongKe();"> Tìm kiếm </button>
            <h2 id="tongdoanhso"> </h2>


        </form>
    </div>





    <!-- Quản lý sản phẩm -->
    <div id="sanpham-content" class="content-section">
        <h1 class="headerad"> QUẢN LÝ SẢN PHẨM</h1>
        <div class="row">
            <div class="col-lg-8">
                <table class="table" style="width: 50;">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Tên</th>
                            <th class="text-center" scope="col">Giá</th>
                            <th class="text-center" scope="col">Thương hiệu</th>
                            <th class="text-center" scope="col">Phân loại</th>
                            <th class="text-center" scope="col">Trọng lượng</th>
                            <th class="text-center" scope="col">Kích thước</th>
                            <th class="text-center" scope="col">Chất liệu</th>
                            <th class="text-center" scope="col">Hình ảnh</th>
                            <th class="text-center" scope="col">Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once __DIR__ . "\Connect.php";
                        // Truy vấn cơ sở dữ liệu để lấy danh sách sản phẩm
                        $sql = "SELECT * FROM products";
                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Truy vấn không hợp lệ:" . $conn->error);
                        }

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                        <tr>
                        <td class='text-center'>" . $row['productID'] . "</td>
                        <td class='text-center'>" . $row['productName'] . "</td>
                        <td class='text-center'>" . $row['productPrice'] . "</td>
                        <td class='text-center'>" . $row['productBrand'] . "</td>
                        <td class='text-center'>" . $row['productType'] . "</td>
                        <td class='text-center'>" . $row['productWeight'] . "</td>
                        <td class='text-center'>" . $row['productSize'] . "</td>
                        <td class='text-center'>" . $row['productMaterial'] . "</td>
                        <td class='text-center'><img style='width: 90px;height: 100px;' src='./images/product/7/" . $row['productImage'] . "'></td>
                        <td >
                        <a href='Update.php?" . $row['productID'] . "' id='openEditModal'><i class='fa-solid fa-wrench'></i></a>
                        <a href='Delete.php?" . $row['productID'] . "'><i class='fa-solid fa-trash'></i></a>
                        </td>
                          </tr>
                        ";
                            }
                        } else {
                            echo "Không có sản phẩm nào";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3">

                <form id="frmnhapsp" action="Create.php" method="POST">
                    <h1 style="color: black;text-align:center;"> Thêm sản phẩm </h1>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Tên</label>
                        <input type="text" name="productName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Giá</label>
                        <input type="text" name="productPrice" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Thương hiệu</label>
                        <input type="text" name="productBrand" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <select name="productType" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <label class="input-group-text" id="inputGroup-sizing-sm">Phân loại</label>
                            <option selected>Chọn loại vợt</option>
                            <option value="beginner">Vợt cho người mới</option>
                            <option value="professional">Vợt chuyên nghiệp</option>
                            <option value="newtech">Vợt công nghệ mới</option>
                            <option value="light">Vợt nhẹ</option>
                            <option value="medium">Vợt trung bình</option>
                            <option value="heavy">Vợt nặng</option>
                            <option value="female">Vợt nữ</option>
                            <option value="children">Vợt trẻ em</option>
                            <option value="new">Vợt đời mới</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Trọng lượng</label>
                        <input type="text" name="productWeight" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Kích thước</label>
                        <input type="text" name="productSize" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Chất liệu</label>
                        <input type="text" name="productMaterial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="containbox">
                        Hình ảnh: <input type="file" name="productImage" id="productImageInput" accept="image/*">
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
            document.getElementById("openEditModal").addEventListener("click", function(event) {
                // Ngăn chặn hành động mặc định của liên kết
                event.preventDefault();
                document.getElementById("editModal").style.display = "block";
            });

            // Đóng popup chỉnh sửa sản phẩm khi bấm vào nút "Đóng"
            function closeEditModal() {
                document.getElementById("editModal").style.display = "none";
            }

            // Xử lý lưu dữ liệu sản phẩm và sau đó đóng popup
            function saveEditedProduct() {
                // Lấy dữ liệu sản phẩm từ các trường input
                var productName = document.getElementById("editProductName").value;
                var productPrice = document.getElementById("editProductPrice").value;
                var productBrand = document.getElementById("editProductBrand").value;
                var productType = document.getElementById("editProductType").value;
                var productWeight = document.getElementById("editProductWeight").value;
                var productSize = document.getElementById("editProductSize").value;
                var productMaterial = document.getElementById("editProductMaterial").value;
                var productImage = document.getElementById("editProductImage").value;

                // Tạo một đối tượng chứa dữ liệu sản phẩm
                var productData = {
                    productName: productName,
                    productPrice: productPrice,
                    productBrand: productBrand,
                    productType: productType,
                    productWeight: productWeight,
                    productSize: productSize,
                    productMaterial: productMaterial,
                    productImage: productImage
                };

                // Gửi yêu cầu AJAX đến server để lưu dữ liệu sản phẩm
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "Update.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Xử lý phản hồi từ server nếu cần
                            console.log("Dữ liệu sản phẩm đã được lưu thành công!");
                            // Sau khi lưu dữ liệu, đóng popup
                            closeEditModal();
                        } else {
                            console.error("Lỗi khi lưu dữ liệu sản phẩm: " + xhr.statusText);
                        }
                    }
                };
                xhr.send(JSON.stringify(productData));
                // Sau khi lưu, đóng popup
                closeEditModal();


                //Xoá ảnh cũ
                function removeExistingImage() {
                    // Clear the existing image and reset the input field
                    var existingImage = document.getElementById('existingImage');
                    existingImage.src = '';

                    var editProductImageInput = document.getElementById('editProductImageInput');
                    editProductImageInput.value = '';
                }
            }
        </script>

        <!-- Bảng chỉnh sửa sản phẩm -->
        <div id="editModal" class="modal" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">

            <form class="modal-content" action="Update.php" method="POST" style="width:35%; margin-left:35%; margin-top:3%; border:solid 2px;" >
                <span style="margin-left:95%" class="close" onclick="closeEditModal()">&times;</span>
                <h1 style="text-align: center;">Chỉnh sửa sản phẩm</h1>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Tên</label>
                        <input type="text" name="productName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Giá</label>
                        <input type="text" name="productPrice" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Thương hiệu</label>
                        <input type="text" name="productBrand" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <select name="productType" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <label class="input-group-text" id="inputGroup-sizing-sm">Phân loại</label>
                            <option selected>Chọn loại vợt</option>
                            <option value="beginner">Vợt cho người mới</option>
                            <option value="professional">Vợt chuyên nghiệp</option>
                            <option value="newtech">Vợt công nghệ mới</option>
                            <option value="light">Vợt nhẹ</option>
                            <option value="medium">Vợt trung bình</option>
                            <option value="heavy">Vợt nặng</option>
                            <option value="female">Vợt nữ</option>
                            <option value="children">Vợt trẻ em</option>
                            <option value="new">Vợt đời mới</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Trọng lượng</label>
                        <input type="text" name="productWeight" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Kích thước</label>
                        <input type="text" name="productSize" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" id="inputGroup-sizing-sm">Chất liệu</label>
                        <input type="text" name="productMaterial" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>

                <div class="containboximg">
                    <label for="existingImage">Hình hiện tại:</label>
                    <img id="existingImage" style="max-width: 100px; max-height: 100px;" alt="Existing Image">
                    <button onclick="removeExistingImage()" style="width:55px; height:auto;">Xoá</button>
                    <br>
                    <label for="editProductImageInput">Chọn hình mới:</label>
                    <input type="file" name="productImage" id="editProductImageInput" accept="image/*">

                    <img id="selectedImage" style="max-width: 100px; max-height: 100px; " alt="Selected Image">
                </div>

                <div><button type="submit" style="width:55px; height:auto; margin-left:45%">Lưu</button> </div>
            </form>
        </div>
    </div>




    <!-- Quản lý hoá đơn -->
    <div id="hoadon-content" class="content-section">
        <?php
        require_once __DIR__ . '/../Model//ModelTransaction.php';

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
                        <td>" . $transactionObj->getTransactionID() . "</td>
                        <td>" . $transactionObj->getUserID() . "</td>
                        <td>" . $transactionObj->getTotal() . "</td>
                        <td>" . $transactionObj->getNote() . "</td>
                        <td>" . $transactionObj->getTime() . "</td>
                        <td>" . $transactionObj->getAddress() . "</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "Không có giao dịch nào.";
        }
        ?>
        <div id="dangxuat-content" class="content-section"></div>
    </div>
</body>

</html>