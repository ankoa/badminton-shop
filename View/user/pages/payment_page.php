<?php
session_start();
require_once __DIR__ . '/../../../Model/ModelProduct.php';
require_once __DIR__ . '/../../../Model/ModelUser.php';
require_once __DIR__ . '/../../../Model/ModelCartDetail.php';
require_once __DIR__ . '/../../../Model/ModelVariantDetail.php';
$modelUser = new ModelUser();
$modelProduct = new ModelProduct();
$modelCartDetail = new ModelCartDetail();
$modelVariantDetail = new ModelVariantDetail();
$cartDetails = $modelCartDetail->getCartDetailByCartID($modelUser->getUIDByUserName($_SESSION['username']));
$total_price_cart = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://shopvnb.com/themes/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://shopvnb.com/themes/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://shopvnb.com/themes/gio_hang/select2-min.css" rel="stylesheet" type="text/css" />
    <link href="https://shopvnb.com/themes/gio_hang/checkout.css?v=1" rel="stylesheet" type="text/css" />
    <script src="https://shopvnb.com/themes/gio_hang/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="https://shopvnb.com/themes/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://shopvnb.com/themes/gio_hang/select2-full-min.js" type="text/javascript"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 20px;
        }

        .main {
            width: 50%;
            padding-right: 0px;
            padding-left: 10%;
        }

        .sidebar {
            width: 40%;
            padding-left: 0px;
            padding-right: 10%;
        }

        .header {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header a {
            color: orange;
            font-weight: bold;
            transition: color 0.1s;
        }

        .header a:hover {
            color: green;
        }

        .small-header {
            font-size: 18px;
            margin-bottom: 10px;
            color: black;
        }

        .input-group {
            margin-bottom: 10px;
            width: 60%;
        }

        .input-group label {
            font-size: 14px;
            color: gray;
            display: block;
            margin-bottom: 5px;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }

        .order-container {
            border: 2px solid orange;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .product {
            margin-bottom: 10px;
        }

        .total {
            border-top: 1px solid lightgray;
            margin-top: 20px;
            padding-top: 10px;
        }

        .payment-options {
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .back-btn {
            color: orange;
            margin-right: 10px;
            transition: color 0.3s;

        }

        .back-btn:hover {
            color: green;
        }


        .submit-btn {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.1s;
        }


        .submit-btn:hover {
            background-color: green;

        }
    </style>
</head>

<body>

    <div class="container">
        <div class="main">
            <div class="header"><a href="#" style="text-decoration: none;">VNBSport</a></div>
            <div class="small-header">Thông tin nhận hàng</div>
            <form>
                <div class="input-group">
                    <label for="fullname">Họ và tên người nhận hàng</label>
                    <input type="text" id="fullname" name="fullname" maxlength="50">
                </div>
                <div class="input-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" maxlength="15">
                </div>
                <div class="input-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address" maxlength="100">
                </div>
                <div class="input-group">
                    <label for="notes">Ghi chú</label>
                    <textarea id="notes" name="notes" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="sidebar">
            <div class="order-container">


                <div class="order-summary order-summary--product-list order-summary--is-collapsed">
                    <div class="summary-body summary-section summary-product">
                        <div class="summary-product-list">
                            <table class="product-table">
                                <tbody>
                                    <?php
                                    foreach ($cartDetails  as $cartDetail) {

                                        $quantity = $cartDetail->getQuantity();
                                        $productID = $cartDetail->getProductID();
                                        $price = $cartDetail->getPrice();
                                        $variantDetail = $modelVariantDetail->getVariantByID($cartDetail->getVariantID());
                                        $total_price_cart += $cartDetail->getPrice();
                                        $productName = $modelProduct->getProductNameByID($productID);
                                        $product = $modelProduct->getProductByID($productID);

                                        $cartData[] = [
                                            'quantity' => $quantity,
                                            'productID' => $productID,
                                            'price' => $price,
                                            'variantDetail' => $variantDetail,
                                            'productName' => $productName,
                                        ];

                                        echo '<tr class="product product-has-image clearfix">';
                                        echo '<td>';
                                        echo '<div class="product-thumbnail">';
                                        echo '<div class="product-thumbnail__wrapper">';
                                        echo '<img src="../../../View/images/product/' . $product->getProductID() . '/' . $variantDetail->getColor() . '/' . $product->getProductID() . '.1.png" alt="' . $product->getName() . '" class="product-thumbnail__image" />';
                                        echo '</div>';
                                        echo '<span class="product-thumbnail__quantity" aria-hidden="true">' . $quantity . '</span>';
                                        echo '</div>';
                                        echo '</td>';
                                        echo '<td class="product-info">';
                                        echo '<span class="product-info-name">' . $productName . '</span>';
                                        echo '</td>';
                                        echo '<td class="product-price text-right">' . number_format($price) . ' ₫ </td>';
                                        echo '</tr>';
                                    }
                                    //  }
                                    ?>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="order-summary order-summary--total-lines">
                    <div class="summary-section border-top-none--mobile">
                        <div class="total-line total-line-total clearfix">
                            <span class="total-line-name pull-left">
                                Tổng tiền:
                            </span>
                            <span class="total-line-price pull-right"> <?php echo number_format($total_price_cart, 0, ',', '.'); ?> ₫</span>
                        </div>
                        <div class="payment-options">
                            <div>
                                <input type="checkbox" id="cashOnDelivery" name="paymentMethod" value="cash" onclick="togglePayment(this)">
                                <label for="cashOnDelivery">Thanh toán khi nhận hàng</label>
                            </div>
                            <div>
                                <input type="checkbox" id="bankTransfer" name="paymentMethod" value="bank" onclick="togglePayment(this)">
                                <label for="bankTransfer">Thanh toán qua ngân hàng</label>
                                <p>Ngân hàng Vietcombank CN Hùng Vương<br>
                                    Số TK: 0987654321<br>
                                    Chủ TK: Kim Duy Long<br>
                                    (Nội dung chuyển khoản: Tên + Số ĐT đặt hàng)
                                </p>
                                <img src="../../../View/images/QRbank.png" alt="QR Code">
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <a href="http://localhost/badminton-shop/Controllers/index.php?control=Cart" class="back-btn">&lt; Quay về giỏ hàng</a>
                        <button type="submit" class="submit-btn">ĐẶT HÀNG</button>
                    </div>
                </div>
            </div>

            <script>
                function togglePayment(checkbox) {
                    var checkboxes = document.getElementsByName(checkbox.name);
                    checkboxes.forEach(function(currentCheckbox) {
                        if (currentCheckbox !== checkbox) {
                            currentCheckbox.checked = false;
                        }
                    });
                }
            </script>

            <script>
                
                $(document).on('click', '.submit-btn', function(event) {
    event.preventDefault();

    // Collect form data
    var fullName = document.getElementById('fullname').value.trim();
    var phone = document.getElementById('phone').value.trim();
    var address = document.getElementById('address').value.trim();
    var note = document.getElementById('notes').value.trim();
    var username = <?php echo $_SESSION['username']; ?>;
    const userID = getUserID(username);
    console.log(fullName);
    console.log(phone);
    console.log(address);
    console.log(note);
    var cartDetails = <?php echo json_encode($cartData); ?>;
    var totalPriceCart = <?php echo $total_price_cart; ?>;
    console.log(totalPriceCart);
    cartDetails.forEach(function(item) {
            console.log('Product ID:', item.productID);
            console.log('Quantity:', item.quantity);
            console.log('Price:', item.price);
            console.log('Variant:', item.variantDetail);
            console.log('Name:', item.productName);
        });
    if (fullName === '' || phone === '' || address === '') {
        alert('Vui lòng nhập đủ thông tin!');
        return;
    }

    // var xhr = new XMLHttpRequest();
    // xhr.open("POST", "/Model/process_order.php", true); // Corrected path
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //         alert('Đặt hàng thành công!');
    //     }
    // };
    // xhr.send("fullname=" + fullName + "&phone=" + phone + "&address=" + address + "&notes=" + note + "&total=" + <?php echo $total_price_cart; ?>);
});

function addTransaction(){
    $.ajax({
        url: '../Controllers/TransactionController.php',
        method: 'POST',
        data: { action: "add", maquyen: ma_nhomquyen, tenquyen: ten_nhomquyen },
        success: function (data) {
            console.log(data);
            $("form").trigger('reset');
            $("#addNhomQuyen").modal("hide");
            alert("Thêm Nhóm Quyền Thành Công")
            loadNhomQuyen();
        }
    })
}
            </script>



</body>

</html>