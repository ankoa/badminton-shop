<?php
require_once __DIR__ . '/../../../Model/ModelProduct.php';
require_once __DIR__ . '/../../../Model/ModelBrand.php';
require_once __DIR__ . '/../../../Model/ModelCatalog.php';
require_once __DIR__ . '/../../../Model/ModelVariant.php';
require_once __DIR__ . '/../../../Model/ModelVariantDetail.php';


// Khởi tạo đối tượng ModelProduct
$modelProduct = new ModelProduct();

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên productID
$productID = 1;
$product = $modelProduct->getProductByID($productID);

// Khởi tạo đối tượng ModelBrand
$modelBrand = new ModelBrand();

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên brandID
$brand = $modelBrand->getBrandByID($product->getBrandID());

// Khởi tạo đối tượng ModelBrand
$modelCatalog = new ModelCatalog();

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên catalogID
$catalog = $modelCatalog->getCatalogByID($product->getCatalogID());


$modelVariant = new ModelVariant();
$listvariants = $modelVariant->getListVariantByProductID($productID);

$modelVariantDetail = new ModelVariantDetail();
$listVariantDetails = [];

foreach ($listvariants as $variant) {
    $variantID = $variant->getVariantID();
    $variantDetail = $modelVariantDetail->getVariantByID($variantID);
    // Thêm chi tiết biến thể vào mảng $listVariantDetails
    $listVariantDetails[] = $variantDetail;
}
$imagePaths = explode(",", reset($listVariantDetails)->getListImage());
if ($catalog->getName() == "Racket") {
} else if ($catalog->getName() == "String") {
} else if ($catalog->getName() == "Shuttle") {
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="=X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    </link>
    <link href="https://cdn.shopvnb.com/themes/css/breadcrumb_style.scss.css" rel="stylesheet" type="text/css" />
    <link rel="preload" as='style' type="text/css" href="https://cdn.shopvnb.com/themes/css/breadcrumb_style.scss.css">
    <link rel="stylesheet" href="../../css/product_detail.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="../../../js/product_detail.js" defer></script>
    <title>test</title>
</head>

<body>
    <div class="bodywrap">
        <section class="bread-crumb">
            <div class="container">
                <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li class="home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a href="https://shopvnb.com" title="Trang chủ" itemprop="item" href=""><span
                                itemprop="name">Trang chủ</span></a>
                        <meta itemprop="position" content="0" />
                        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas"
                                data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                                <path fill="currentColor"
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                    class=""></path>
                            </svg>&nbsp;</span>
                    </li>

                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                        <a itemprop="item" href="giay-cau-long.html" title="Giày Cầu Lông"><span itemprop="name">Giày
                                Cầu Lông</span></a>

                        <meta itemprop="position" content="1" />
                        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas"
                                data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                                <path fill="currentColor"
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                    class=""></path>
                            </svg>&nbsp;</span>
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">

                        <a itemprop="item" href="giay-cau-long-mizuno.html" title="Giày Cầu Lông Mizuno"><span
                                itemprop="name">Giày Cầu Lông Mizuno</span></a>

                        <meta itemprop="position" content="2" />
                        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas"
                                data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                                <path fill="currentColor"
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                    class=""></path>
                            </svg>&nbsp;</span>
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <strong itemprop="name">
                            <?php echo $product->getName(); ?>
                        </strong>
                        <meta itemprop="position" content="3" />
                    </li>
                </ul>
            </div>
        </section>

        <div class="product-container">
            <div class="product-img">
                <div class="big-img">

                </div>
                <div class="img-container">
                    <div class="slider-wrapper">
                        <button id="prev-slide" class="slide-button material-symbols-rounded">
                            chevron_left
                        </button>
                        <ul class="image-list" id="image-list">
                            <img class="image-item" src=<?php echo reset($imagePaths); ?> alt="img-1" />
                            <script>
                                // Đảm bảo rằng biến imagePaths đã được định nghĩa trước
                                const imagePaths = <?php echo json_encode($imagePaths); ?>;

                                // Lặp qua mỗi đường dẫn hình ảnh và chèn chúng vào danh sách
                                imagePaths.forEach((path, index) => {
                                    // Tạo một thẻ img và đặt thuộc tính src và alt
                                    const image = document.createElement('img');
                                    image.src = path;
                                    image.alt = `Image ${index + 1}`; // Tùy chỉnh alt nếu cần
                                    image.classList.add('image-item');

                                    // Chọn ul danh sách hình ảnh
                                    const container = document.getElementById("image-list");

                                    // Kiểm tra xem danh sách có tồn tại không trước khi chèn hình vào
                                    if (container) {
                                        container.appendChild(image);
                                    } else {
                                        console.error(`UL with id 'image-list' not found.`);
                                    }
                                });
                            </script>
                        </ul>
                        <button id="next-slide" class="slide-button material-symbols-rounded">
                            chevron_right
                        </button>
                    </div>
                </div>

            </div>

            <div class="product-detail">
                <h1 class="title-product">
                    <?php echo $product->getName(); ?>
                </h1>
                <div class="product-code">
                    <span content="123456789" style="font-size: 14px;">
                        Mã:
                        <span class="code">VNB
                            <?php echo $product->getProductID(); ?>
                        </span>
                    </span>
                </div>

                <div class="product-quantity">
                    <span class="mb-break">
                        <span class="brand-title">Thương hiệu</span>
                        <a class="a-vendor" href="">
                            <?php echo $brand->getName(); ?>
                        </a>
                    </span>
                    <span class="line">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <span class="mb-break" id="tinhtrang">
                        <script>
                            const racket = <?php echo json_encode(reset($listVariantDetails)); ?>;
                            if (racket && racket.quantity <= 0) {
                                document.getElementById('tinhtrang').innerHTML = '<span class="brand-title">Tình trạng: </span><span class="a-vendor">Hết hàng</span>';
                            } else {
                                document.getElementById('tinhtrang').innerHTML = '<span class="brand-title">Tình trạng: </span><span class="a-vendor">Còn hàng</span>';
                            }
                        </script>
                    </span>

                </div>

                <form>
                    <div class="price-box">
                        <span class="special-price">
                            <span class="price product-price">
                                <?php echo number_format($product->getPrice(), 0, ',', '.'); ?> ₫
                            </span>
                        </span>

                        <span class="old-price">
                            Giá niêm yết:
                            <del class="price product-price-old">
                                <?php echo number_format($product->getDiscount(), 0, ',', '.'); ?> ₫
                            </del>
                        </span>
                    </div>

                    <fieldset class="pro-discount uu-dai" style="margin-top: 10px;">
                        <legend>
                            <img src="../../images/icon/code_dis.gif" alt="khuyến mãi">ƯU ĐÃI
                        </legend>
                        <div class="product-promotions-list-content">
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                                <a href="">VNB 001</a>, <a href="">VNB 001</a> hoặc <a href="">VNB 001</a>
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>&nbsp;</p>
                            <span style="font-family:verdana,geneva,sans-serif">
                                <strong>
                                    🎁Ưu đãi thêm khi mua sản phẩm tại
                                    <a href="https://shopvnb.com/cua-hang-vnb-premium.html">VNB Premium</a>
                                </strong>
                            </span>
                            <p>
                                <span style="font-family:verdana,geneva,sans-serif">✅ <a
                                        href="https://shopvnb.com/son-logo-mat-vot-mien-phi-tai-shop-vnb-premium.html">Sơn
                                        logo mặt vợt</a> miễn phí</span>
                            </p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a
                                        href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a
                                        href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a
                                        href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a
                                        href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                        </div>
                    </fieldset>
                    <div class="form-product">
                        <?php if ($catalog->getName() == 'Shuttle'): ?>
                            <div class="select-swatch">
                                <div class="swatch clearfix">
                                    <div class="header">Chọn tốc độ: </div>
                                    <?php foreach ($listVariantDetails as $variantDetail): ?>
                                        <?php if ($variantDetail->getQuantity() > 0): ?>
                                            <div class="swatch-element color-<?php echo $variantDetail->getSpeed(); ?>"
                                                data-value="<?php echo $variantDetail->getSpeed(); ?>"
                                                data-value_2="<?php echo $variantDetail->getSpeed(); ?>">
                                                <input id="color-<?php echo $variantDetail->getSpeed(); ?>" type="radio"
                                                    name="color" value="<?php echo $variantDetail->getSpeed(); ?>">
                                            <?php else: ?>
                                                <div class="swatch-element soldout color-<?php echo $variantDetail->getSpeed(); ?>"
                                                    data-value="<?php echo $variantDetail->getSpeed(); ?>"
                                                    data-value_2="<?php echo $variantDetail->getSpeed(); ?>">
                                                    <input disabled id="color-<?php echo $variantDetail->getSpeed(); ?>"
                                                        type="radio" name="color" value="<?php echo $variantDetail->getSpeed(); ?>">
                                                <?php endif; ?>
                                                <label for="color-<?php echo $variantDetail->getSpeed(); ?>">
                                                    <?php echo $variantDetail->getSpeed(); ?>
                                                    <img class="crossed-out"
                                                        src="https://cdn.shopvnb.com/themes/images/soldout.png"
                                                        alt="<?php echo $variantDetail->getSpeed(); ?>">
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="select-swatch">
                                <div class="swatch clearfix">
                                    <div class="header">Chọn màu: </div>
                                    <?php
                                    // Mảng tạm thời để lưu trữ các màu đã xuất hiện
                                    $seenColors = [];

                                    foreach ($listVariantDetails as $variantDetail):
                                        // Lấy màu của biến thể hiện tại
                                        $color = $variantDetail->getColor();

                                        // Kiểm tra xem màu đã được thêm vào mảng tạm thời chưa
                                        if (!in_array($color, $seenColors)):
                                            // Thêm màu vào mảng tạm thời
                                            $seenColors[] = $color;

                                            // Hiển thị swatch-element cho màu
                                            ?>
                                            <div class="swatch-element <?php if ($modelVariantDetail->getVariantQuantityByColor($listVariantDetails, $color) <= 0):
                                                echo "soldout";
                                            endif; ?> color-<?php echo $color; ?>"
                                                data-value="<?php echo $color; ?>" data-value_2="<?php echo $color; ?>">
                                                <input <?php if ($modelVariantDetail->getVariantQuantityByColor($listVariantDetails, $color) <= 0):
                                                echo "disabled";
                                            endif; ?> id="color-<?php echo $color; ?>" type="radio" name="color"
                                                    value="<?php echo $color; ?>">
                                                <label for="color-<?php echo $color; ?>">
                                                    <?php echo $color; ?>
                                                    <img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png"
                                                        alt="<?php echo $color; ?>">
                                                </label>
                                            </div>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="boz-form">
                            <div class="clearfix form-group">
                                <div class="flex-quantity">
                                    <div class="custom custom-btn-number show">
                                        <div class="input_number_product">
                                            <button class="btn_num num_1 button button_qty"
                                                onclick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro ) &amp;&amp; qtypro > 1 ) result.value--;return false;"
                                                type="button">-</button>
                                            <input type="text" id="qtym" name="so_luong" value="1" maxlength="3"
                                                class="form-control prd_quantity"
                                                onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"
                                                onchange="if(this.value == 0)this.value=1;">
                                            <button class="btn_num num_2 button button_qty"
                                                onclick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;"
                                                type="button"><span>+</span></button>
                                        </div>
                                    </div>
                                    <div class="btn-mua button_actions clearfix">

                                        <button type="submit"
                                            class="btn btn_base normal_button btn_add_cart add_to_cart btn-cart"><span
                                                class="txt-main">Thêm vào giỏ hàng</span></button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
        </form>


    </div>

    <div class="description">
        <div class="tab-header">
            <button class="tab-button active" data-tab="tab1">Mô tả sản phẩm</button>
            <button class="tab-button" data-tab="tab2">Thông số kỹ thuật</button>
        </div>
        <div class="tab-content" id="tab1">
            Content for Tab 1
        </div>
        <div id="tab2" class="tab-content content_extab" style="display: none;">
            <div class="thongso-container">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="30%"><b>Trình Độ Chơi:</b></td>
                            <td>Khá Tốt</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Chiều dài vợt:</b></td>
                            <td>675 mm </td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Nội Dung Chơi:</b></td>
                            <td>Cả Đơn và Đôi</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Điểm Cân Bằng:</b></td>
                            <td>Nặng Đầu</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Trọng Lượng:</b></td>
                            <td>3U: 85 - 89g</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Phong Cách Chơi:</b></td>
                            <td>Tấn Công</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Độ Cứng Đũa:</b></td>
                            <td>Cứng</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>









</body>

</html>