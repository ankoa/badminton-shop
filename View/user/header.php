<?php
session_start();
$total_price_cart=0;
?>
<div class="header_contentTop">
    <div class="left_header_contentTop">
            <div class="logo">
                <img src="../View/images/logo.png">
            </div>
            <a href="#"> HOTLINE: 0123456789 | 0987654321 </a>
        </div>
        <div class="center_header_contentTop">
            <form action="" method="POST" id="search_box" name="search_box">
                <li class="search-box"> 
                    <input type="search" name="search_text" id="search_text" placeholder="Bạn muốn tìm gì !!!!" value=""> 
                    <button type="submit" name="search_button" id="search_button">Tìm kiếm</button>
                </li>
            </form>
            <ul class="search-list" id="searchList">
                <!-- Nơi hiển thị kết quả tìm kiếm -->
            </ul>

        </div>

        <div class="right_header_contentTop">
            <div class="icon-item">
                <li>
                    <i class="fa-solid fa-clipboard-list" style="color: #e95221;"></i>
                    <span class="icon-name">TRA CỨU</span>
                    <ul class="submenu_check" style="height: 30px;">
                            <li class="dropdown-item"  style="height: 100%;"> <a href="index.php?control=checkDonHang"> Kiểm tra đơn hàng </a></li>
                    </ul>
                </li>
            </div>
            <div class="icon-item">
                <li>
                    <i class="fa-solid fa-user" style="color: #e95221;"></i>
                    <span class="icon-name" id="spanTK">
                    <?php 
                    if(isset($_SESSION['login'])){
                        if ($_SESSION['login'] == true && !empty($_SESSION['username'])) {
                            echo strtoupper($_SESSION['username']);
                        } else {
                            echo "TÀI KHOẢN";
                        }
                    } else {
                        echo "TÀI KHOẢN";
                    }
                    ?>
                </span>
                <?php 
                if(isset($_SESSION['login'])){
                    if ($_SESSION['login'] == true && !empty($_SESSION['username'])) {
                        echo '
                        <ul class="submenu_user">
                            <li class="dropdown-item"> <a href="index.php?control=infor-user"> Thông tin </a></li>
                            <li class="dropdown-item"> <a href="index.php?control=logout"> Đăng xuất</a></li>
                        </ul>
                        ';
                    } else {
                        echo '
                        <ul class="submenu_user">
                            <li class="dropdown-item"> <a href="index.php?control=signin"> Đăng nhập </a></li>
                            <li class="dropdown-item"> <a href="index.php?control=signup"> Đăng kí</a></li>
                        </ul>';
                    }
                } else {
                    echo '
                    <ul class="submenu_user">
                        <li class="dropdown-item"> <a href="index.php?control=signin"> Đăng nhập </a></li>
                        <li class="dropdown-item"> <a href="index.php?control=signup"> Đăng kí</a></li>
                    </ul>';
                }
                ?>


            </li>
        </div>
        <div class="icon-item">
            <li href="index.php?control=Cart">
                <ul class="show-item"> 
                        <a class="a-head" href="index.php?control=Cart"><i class="fa-solid fa-cart-arrow-down" style="color: #e95221;"></i></a>
                        <span class="icon-name"><a class="a-head" href="index.php?control=Cart"><span class="icon-name" id="spanGH">GIỎ HÀNG</span></a></span>
                </ul>
            </li>
        </div>
    </div>

</div>
<div class="header_contentBottom">
    <li> <a class="titlemenu" href="index.php">TRANG CHỦ</a> </li>
    <li>
        <a class="titlemenu" href="index.php?control=ProductCategory&id=1">SẢN PHẨM</a>
        <ul class="submenu">
            <?php
            require_once('../Model/ModelCatalog.php');
            require_once('../Model/ModelBrand.php');

            $modelBrand = new ModelBrand();
            $modelCatalog = new ModelCatalog();
            $catalogs = $modelCatalog->getAllCatalogs();

            if (is_array($catalogs) && !empty($catalogs)) {
                foreach ($catalogs as $catalog) {
                    $temp = null;
                    if ($catalog->getName() == "Racket") {
                        $temp = "Vợt cầu lông ";
                    } elseif ($catalog->getName() == "String") {
                        $temp = "Lưới cầu lông ";
                    } elseif ($catalog->getName() == "Shuttle") {
                        $temp = "Quả cầu lông ";
                    } else $temp = "Giày cầu lông ";
                    echo '
                                <li> 
                                    <a href="index.php?control=ProductCategory&id=1">' . $temp . '</a> 
                                    <ul class="menu_item">';
                    $brandIDs = $modelBrand->suggestBrandIDsForCatalog($catalog->getCatalogID());
                    foreach ($brandIDs as $brandID) {
                        $brand = $modelBrand->getBrandByID($brandID);
                        echo '<li>' . $temp . $brand->getName() . '</li>';
                    }

                    echo '
                                        <li>Xem thêm</li>
                                    </ul>
                                </li>';
                }
            } else {
                echo "Không thể lấy dữ liệu từ cơ sở dữ liệu hoặc không có dữ liệu nào được tìm thấy";
            }
            ?>
        </ul>



    </li>
    <li> <a class="titlemenu" href="index.php?control=IntroduceCategory">GIỚI THIỆU</a></li>
    <li> <a class="titlemenu" href="index.php?control=ContactCategory">LIÊN HỆ</a></li>
</div>

<form action class="popup-cart">
                <div class="title-cart-head">Giỏ hàng</div>
                <div class="cart-body">
                    <div class="ajaxcart-row">
                    <?php 
                        require_once('../Model/ModelVariantDetail.php');
                        require_once('../Model/ModelUser.php');
                        require_once('../Model/ModelProduct.php');
                        require_once('../Model/ModelCartDetail.php');
                        $modelVariantDetail = new ModelVariantDetail();
                        $modelUser = new ModelUser();
                        $modelProduct = new ModelProduct();
                        $modelCartDetail = new ModelCartDetail();
                        $cartDetails=$modelCartDetail->getCartDetailByCartID($modelUser->getUIDByUserName($_SESSION['username']));
                        foreach ($cartDetails  as $cartDetail) {
                            $variantDetail = $modelVariantDetail->getVariantByID(($cartDetail)->getVariantID());
                            $product = $modelProduct->getProductByID(($cartDetail)->getProductID());
                            $total_price_cart+=$product->getPrice();
                            echo "
                            <div class='cart-product'>
                        <a href='#' class='cart-image' title='" . $product->getName() . "'><img width='80' height='80' src='../View/images/product/GiayNam.png' 
                        alt='" . $product->getName() . "'></a>
                        <div class='cart-info'>
                            <div class='cart-name'>
                                <a href='#' class='' title='" . $product->getName() . "'>" . $product->getName() . "</a>";
                            if ($variantDetail->getColor() != null)
                                echo "<span class='variant-title'>Màu: " . $variantDetail->getColor() . "</span>";
                            if ($variantDetail->getWeight() != null && $variantDetail->getGrip() != null)
                                echo "<span class='variant-title'>Bản: " . ($variantDetail->getWeight().''.$variantDetail->getGrip()) . "</span>";
                            if ($variantDetail->getSize() != null)
                                echo "<span class='variant-title'>Size: " . $variantDetail->getSize() . "</span>";
                            if ($variantDetail->getSpeed() != null)
                                echo "<span class='variant-title'>Tốc độ: " . $variantDetail->getSpeed() . "</span>";
                            echo "
                    </div>
                    <div class='grid'>
                        <div class='cart-item-name'>
                            <div class='input-group-btn'>
                                <button class='qty-minus' onclick='var result = document.getElementById(\"qtym\"); var qtypro = parseInt(result.value); if (!isNaN(qtypro) && qtypro > 1) result.value = qtypro - 1; return false;' type='button'>-</button>
                                <input type='text' id='qtym' name='so_luong' value='1' maxlength='3' class='in' onkeypress='if (isNaN(this.value + String.fromCharCode(event.keyCode))) return false;' onchange='if(this.value == 0) this.value=1;'>
                                <button class='qty-plus' onclick='var result = document.getElementById(\"qtym\"); var qtypro = parseInt(result.value); if (!isNaN(qtypro)) result.value = qtypro + 1; return false;' type='button'><span>+</span></button>
                            </div>
                        </div>
                        <div class='cart-prices'>
                            <span class='cart-price'>" . number_format($product->getPrice(), 0, '.', '.') . "₫</span>
                        </div>
                    </div>
                </div>
            </div>";
                        }
                        ?>

            
        </div>
    </div>
                <div class="ajaxcart-footer">
                    <div class="ajaxcart-subtotal">
                        <div class="cart-subtotal">
                            <div class="cart-col-6">Tổng tiền:</div>
                            <div class="text-right cart-totle"><span class="total-price"><?php echo number_format($total_price_cart , 0, '.', '.'); ?>₫</span></div>
                        </div>
                    </div>
                    <div class="cart-btn-proceed-checkout-dt ">
                        <button onclick="location.href='/gio-hang/thanh-toan'" type="button" class="button btn btn-default cart-btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Đặt hàng</button>
                    </div>
                </div>
            </form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $('#search_box').on('submit', function(event) {
        event.preventDefault();
        var searchText = $('#search_text').val().trim();

        $.ajax({
            type: 'POST',
            url: '../../Controllers/search_products.php', // Đường dẫn đúng đến file PHP
            data: { search_text: searchText },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var outputHtml = '';
                response.forEach(function(product) {
                    outputHtml += '<li>' + product.name + ' - ' + product.description + '</li>';
                });
                $('#searchList').html(outputHtml);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script> -->
<script>
    const popupCart = document.querySelector('.popup-cart');
    const showItem = document.querySelector('.show-item');

    // Thêm sự kiện khi di chuột qua biểu tượng giỏ hàng
    showItem.addEventListener('mouseover', function(event) {
        popupCart.style.display = 'block'; // Hiển thị pop-up
    });

    // Thêm sự kiện khi di chuột ra khỏi biểu tượng giỏ hàng
    showItem.addEventListener('mouseleave', function(event) {
        const toElement = event.toElement || event.relatedTarget;
        // Kiểm tra xem con trỏ đi ra khỏi phần tử popupCart
        if (!popupCart.contains(toElement) || showItem.contains(toElement)) {
            popupCart.style.display = "none"; // Ẩn pop-up
        }
    });
</script>
