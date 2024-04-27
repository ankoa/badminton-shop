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

        <li>
            <input placeholder="Tìm kiếm..." type="text">
            <i class="fa fa-search" aria-hidden="true" style="color: #e95221;"></i>
        </li>

    </div>
    <div class="right_header_contentTop">
        <div class="icon-item">
            <li>
                <i class="fa-solid fa-clipboard-list" style="color: #e95221;"></i>
                <span class="icon-name">TRA CỨU</span>
                <ul class="submenu_check">
                    <li class="dropdown-item"> <a href="index.php?control=checkDonHang"> Kiểm tra đơn hàng </a></li>
                </ul>
            </li>
        </div>
        <div class="icon-item">
            <li>
                <i class="fa-solid fa-user" style="color: #e95221;"></i>
                <span class="icon-name" id="spanTK">
                    <?php
                    if (isset($_SESSION['login'])) {
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
                if (isset($_SESSION['login'])) {
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
                                   </ul>
                               ';
                    }
                } else {
                    echo '
                                    <ul class="submenu_user">
                                        <li class="dropdown-item"> <a href="index.php?control=signin"> Đăng nhập </a></li>
                                         <li class="dropdown-item"> <a href="index.php?control=signup"> Đăng kí</a></li>
                                    </ul>
                                ';
                }
                ?>


            </li>
        </div>

        <div class="icon-item" id="hover-cart">
            <li href="index.php?control=Cart">
                <ul class="show-item" onmouseover="showTarget()" onmouseout="hideTarget()"> 
                        <a class="a-head" href="index.php?control=Cart"><i class="fa-solid fa-cart-arrow-down" style="color: #e95221;"></i></a>
                        <span class="icon-name"><a class="a-head" href="index.php?control=Cart"><span class="icon-name" id="spanGH">GIỎ HÀNG</span></a></span>
        <!-- <div class="icon-item">
            <li>
                <ul class="show-item"> 
                        <i class="fa-solid fa-cart-arrow-down" style="color: #e95221;"></i>
                        <span class="icon-name"><a class="a-head" href="index.php?control=Cart">Giỏ Hàng</a></span>                     -->
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
                                    <a href="">' . $temp . '</a> 
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

            <form action class="popup-cart" onmouseover="showTarget()" onmouseout="hideTarget()">
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

                        <div class="popup-cart">
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
                        </div>
<script>
    var siuElement = document.getElementById('hover-cart');
    var targetElement = document.querySelector('.popup-cart');
    var hoverTimeout;

    var siuRect = siuElement.getBoundingClientRect();

    targetElement.style.position = 'absolute';
    targetElement.style.top = siuRect.top+ 50 + 'px';

    function showTarget() {
    var targetElement = document.querySelector('.popup-cart');
    clearTimeout(hoverTimeout);
    targetElement.style.display = 'block';
}

function hideTarget() {
    var targetElement = document.querySelector('.popup-cart');
    hoverTimeout = setTimeout(function () {
        targetElement.style.display = 'none';
    }, 100);
}

    
</script>
