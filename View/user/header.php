<?php 
    session_start();
?>
<div class="header_contentTop">
        <div class="left_header_contentTop">
            <div class="logo">
                <img src="../View/images/logo.png">
            </div>
            <a href="#"> HOTLINE: 0123456789 | 0987654321 </a>
        </div>
        
        <div class="center_header_contentTop">
        <form action="" method="POST" id="search_box">
            
            <li class="search-box"> 
                <input type="search" name="search_text" id="search_text" placeholder="Bạn muốn tìm gì !!!!" value=""> 
                <button type="submit" name="search_button">Tìm kiếm</button>
            </li>
            <ul class="search-list" id="searchList">
                <?php
                // Khai báo mảng chứa danh sách sản phẩm (có thể lấy từ cơ sở dữ liệu)
                $products = [
                    ['name' => 'Áo thun nam', 'description' => 'Áo thun nam màu đen'],
                    ['name' => 'Quần jean nữ', 'description' => 'Quần jean nữ size M'],
                    ['name' => 'Giày thể thao', 'description' => 'Giày thể thao chạy bộ']
                ];

                if (isset($_POST['search_button'])) {
                    $searchText = strtolower($_POST['search_text']);
                    foreach ($products as $product) {
                        $productName = strtolower($product['name']);
                        if (strpos($productName, $searchText) !== false && $searchText !== '') {
                            echo '<li>' . $product['name'] . ' - ' . $product['description'] . '</li>';
                        }
                    }
                }
                ?>
            </ul>   
        </form>
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
                            }else {
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
                                   </ul>
                               ';
                           }
                        }  else {
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
            <div class="icon-item">
                <li>
                    <i class="fa-solid fa-cart-arrow-down" style="color: #e95221;"></i>
                    <span class="icon-name">GIỎ HÀNG</span>
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
                                if($catalog->getName() == "Racket"){
                                    $temp = "Vợt cầu lông ";        
                                }
                                elseif ($catalog->getName() == "String"){
                                    $temp = "Lưới cầu lông ";        
                                } 
                                elseif ($catalog->getName() == "Shuttle"){
                                    $temp = "Quả cầu lông ";        
                                }
                                else $temp = "Giày cầu lông ";         
                                echo '
                                <li> 
                                    <a href="index.php?control=ProductCategory&id=1">' . $temp . '</a> 
                                    <ul class="menu_item">';
                                    $brandIDs = $modelBrand->suggestBrandIDsForCatalog($catalog->getCatalogID());
                                    foreach ($brandIDs as $brandID) {
                                        $brand = $modelBrand->getBrandByID($brandID);
                                            echo '<li>' .$temp. $brand->getName() . '</li>';
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
