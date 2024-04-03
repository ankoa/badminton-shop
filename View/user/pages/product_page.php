
<?php
require_once __DIR__ . '/../../../Model/ModelProduct.php';
require_once __DIR__ . '/../../../Model/ModelBrand.php';
require_once __DIR__ . '/../../../Model/ModelCatalog.php';
require_once __DIR__ . '/../../../Model/ModelVariant.php';
require_once __DIR__ . '/../../../Model/ModelVariantDetail.php';

// Khởi tạo đối tượng ModelBrand
$modelCatalog = new ModelCatalog();
// Khởi tạo đối tượng ModelProduct
$modelProduct = new ModelProduct();
$catalogID = $_GET['id'];
$catalog = $modelCatalog->getCatalogByID($catalogID);

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên productID
$productID = 16;
$product = $modelProduct->getProductByID($productID);

// Khởi tạo đối tượng ModelBrand
$modelBrand = new ModelBrand();
$listBrands = $modelBrand->getAllBrands();




// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên catalogID
//$catalog = $modelCatalog->getCatalogByID($product->getCatalogID());


$modelVariant = new ModelVariant();
$listvariants = $modelVariant->getListVariantByProductID($productID);

$modelVariantDetail = new ModelVariantDetail();
$listVariantDetails = [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.shopvnb.com/themes/css/bootstrap-4-3-min.css">
    <link href="https://cdn.shopvnb.com/themes/css/danh_muc_style.scss.css?v=16" rel="stylesheet" type="text/css" />
    <link rel="preload" as='style' type="text/css" href="https://cdn.shopvnb.com/themes/css/sidebar_style.scss.css">
    <link href="https://cdn.shopvnb.com/themes/css/sidebar_style.scss.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </div>
    <link rel="preload" as="style" href="https://cdn.shopvnb.com/themes/css/ajaxcart.scss.css" type="text/css">
    <link href="https://cdn.shopvnb.com/themes/css/ajaxcart.scss.css" rel="stylesheet" type="text/css" />
    <div class="backdrop__body-backdrop___1rvky"></div>
    <script src="../../../js/nav.js" defer></script>
    <link rel="stylesheet" href="../../css/product_nav.css">
    <link href="https://cdn.shopvnb.com/themes/css/breadcrumb_style.scss.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="nav-container">
        <div class="nav-row">
            <aside class="dqdt-sidebar">
                <div class="section-box-bg">
                    <div class="filter-content">
                        <div class="filter-container">
                            <div class="filter-container__selected-filter" id="filter-container">
                                <div class="filter-container__selected-filter-header clearfix">
                                    <span class="filter-container__selected-filter-header-title"> Bạn chọn</span>
                                    <a href="javascript:void(0)" onclick="clearAllFiltered()" class="filter-container__clear-all">Bỏ hết <i class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="10" height="10" x="0" y="0" viewBox="0 0 365.696 365.696" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path xmlns="http://www.w3.org/2000/svg" d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0" fill="#ffffff" data-original="#000000" style="" class=""></path>
                                                </g>
                                            </svg></i></a>
                                </div>
                                <div class="filter-container__selected-filter-list">
                                    <ul id="filter">

                                    </ul>
                                </div>
                            </div>
                            <aside class="aside-item filter-price">
                                <div class="aside-title">
                                    <h2><span>Chọn mức giá</span></h2>
                                </div>
                                <div class="aside-content filter-group content_price">
                                    <ul>
                                        <li class="filter-item filter-item--check-box filter-item--green">
                                            <span>
                                                <label for="filter-duoi-500-000d">
                                                    <input type="checkbox" id="filter-duoi-500-000d" onchange="toggleFilter(this);" data-group="Khoảng giá" data-field="gia" data-text="Dưới 500.000đ" value="0-500000" data-operator="OR">
                                                    <i class="fa"></i>
                                                    Giá dưới 500.000đ
                                                </label>
                                            </span>
                                        </li>
                                        <li class="filter-item filter-item--check-box filter-item--green">
                                            <span>
                                                <label for="filter-500-000d-1000-000d">
                                                    <input type="checkbox" id="filter-500-000d-1000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="gia" data-text="500.000đ - 1 triệu" value="500000-1000000" data-operator="OR">
                                                    <i class="fa"></i>
                                                    500.000đ - 1 triệu
                                                </label>
                                            </span>
                                        </li>
                                        <li class="filter-item filter-item--check-box filter-item--green">
                                            <span>
                                                <label for="filter-1000-000d-2000-000d">
                                                    <input type="checkbox" id="filter-1000-000d-2000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="gia" data-text="1 - 2 triệu" value="1000000-2000000" data-operator="OR">
                                                    <i class="fa"></i>
                                                    1 - 2 triệu
                                                </label>
                                            </span>
                                        </li>
                                        <li class="filter-item filter-item--check-box filter-item--green">
                                            <span>
                                                <label for="filter-2000-000d-3000-000d">
                                                    <input type="checkbox" id="filter-2000-000d-3000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="gia" data-text="2 - 3 triệu" value="2000000-3000000" data-operator="OR">
                                                    <i class="fa"></i>
                                                    2 - 3 triệu
                                                </label>
                                            </span>
                                        </li>

                                        <li class="filter-item filter-item--check-box filter-item--green">
                                            <span>
                                                <label for="filter-tren3-000-000d">
                                                    <input type="checkbox" id="filter-tren3-000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="gia" data-text="Trên 3 triệu" value="3000000-0" data-operator="OR">
                                                    <i class="fa"></i>
                                                    Giá trên 3 triệu
                                                </label>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                            <aside class="aside-item filter-vendor f-left">
                                <div class="aside-title">
                                    <h2 class="title-filter title-head margin-top-0"><span>Thương hiệu</span></h2>
                                </div>
                                <div class="aside-content margin-top-0 filter-group">
                                    <ul class="filter-vendor">
                                        <?php foreach ($listBrands as $brand) : ?>
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <label data-filter="filter-th-<?php echo $brand->getBrandID(); ?>" for="filter-th-<?php echo $brand->getBrandID(); ?>" class="th-<?php echo $brand->getBrandID(); ?>">
                                                    <input type="checkbox" id="filter-th-<?php echo $brand->getBrandID(); ?>" onchange="toggleFilter(this)" data-group="Hãng" data-field="thuong_hieu" data-text="<?php echo $brand->getName(); ?>" value="<?php echo $brand->getBrandID(); ?>" data-operator="OR">
                                                    <i class="fa"></i>
                                                    <?php echo $brand->getName(); ?>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </aside>

                            <?php if ($catalog->getName() == "Racket") : ?>
                                <aside class="aside-item filter-ts-trong-luong">
                                    <div class="aside-title">
                                        <h2 class="title-head margin-top-0"><span>Trọng Lượng</span></h2>
                                    </div>
                                    <div class="aside-content filter-group">
                                        <ul class="filter-thong_so-trong-luong">
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <label data-filter="filter-trong-luong-2u-90-94g" for="filter-trong-luong-2u-90-94g" class="filter-trong-luong-2u-90-94g">
                                                    <input type="checkbox" id="filter-trong-luong-2u-90-94g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="2U: 90 - 94g" value="2u-90-94g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    2U: 90 - 94g
                                                </label>
                                            </li>
                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-3u-85-89g" for="filter-trong-luong-3u-85-89g" class="filter-trong-luong-3u-85-89g">
                                                    <input type="checkbox" id="filter-trong-luong-3u-85-89g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="3U: 85 - 89g" value="3u-85-89g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    3U: 85 - 89g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-4u-80-84g" for="filter-trong-luong-4u-80-84g" class="filter-trong-luong-4u-80-84g">
                                                    <input type="checkbox" id="filter-trong-luong-4u-80-84g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="4U: 80 - 84g" value="4u-80-84g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    4U: 80 - 84g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-5u-75-79g" for="filter-trong-luong-5u-75-79g" class="filter-trong-luong-5u-75-79g">
                                                    <input type="checkbox" id="filter-trong-luong-5u-75-79g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="5U: 75 - 79g" value="5u-75-79g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    5U: 75 - 79g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-f-70-74g" for="filter-trong-luong-f-70-74g" class="filter-trong-luong-f-70-74g">
                                                    <input type="checkbox" id="filter-trong-luong-f-70-74g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="F: 70 - 74g" value="f-70-74g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    F: 70 - 74g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-2f-65-69g" for="filter-trong-luong-2f-65-69g" class="filter-trong-luong-2f-65-69g">
                                                    <input type="checkbox" id="filter-trong-luong-2f-65-69g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="2F: 65 - 69g" value="2f-65-69g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    2F: 65 - 69g
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </aside>

                                <aside class="aside-item filter-ts-trong-luong">
                                    <div class="aside-title">
                                        <h2 class="title-head margin-top-0"><span>Cán cầm</span></h2>
                                    </div>
                                    <div class="aside-content filter-group">
                                        <ul class="filter-thong_so-trong-luong">
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <label data-filter="filter-trong-luong-2u-90-94g" for="filter-trong-luong-2u-90-94g" class="filter-trong-luong-2u-90-94g">
                                                    <input type="checkbox" id="filter-trong-luong-2u-90-94g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="2U: 90 - 94g" value="2u-90-94g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    2U: 90 - 94g
                                                </label>
                                            </li>
                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-3u-85-89g" for="filter-trong-luong-3u-85-89g" class="filter-trong-luong-3u-85-89g">
                                                    <input type="checkbox" id="filter-trong-luong-3u-85-89g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="3U: 85 - 89g" value="3u-85-89g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    3U: 85 - 89g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-4u-80-84g" for="filter-trong-luong-4u-80-84g" class="filter-trong-luong-4u-80-84g">
                                                    <input type="checkbox" id="filter-trong-luong-4u-80-84g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="4U: 80 - 84g" value="4u-80-84g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    4U: 80 - 84g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-5u-75-79g" for="filter-trong-luong-5u-75-79g" class="filter-trong-luong-5u-75-79g">
                                                    <input type="checkbox" id="filter-trong-luong-5u-75-79g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="5U: 75 - 79g" value="5u-75-79g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    5U: 75 - 79g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-f-70-74g" for="filter-trong-luong-f-70-74g" class="filter-trong-luong-f-70-74g">
                                                    <input type="checkbox" id="filter-trong-luong-f-70-74g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="F: 70 - 74g" value="f-70-74g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    F: 70 - 74g
                                                </label>
                                            </li>

                                            <li class="filter-item filter-item--check-box filter-item--green ">
                                                <label data-filter="filter-trong-luong-2f-65-69g" for="filter-trong-luong-2f-65-69g" class="filter-trong-luong-2f-65-69g">
                                                    <input type="checkbox" id="filter-trong-luong-2f-65-69g" onchange="toggleFilter(this);" data-group="Trọng Lượng" data-field="trong-luong" data-text="2F: 65 - 69g" value="2f-65-69g" data-operator="OR">
                                                    <i class="fa"></i>
                                                    2F: 65 - 69g
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </aside>
                            <?php elseif ($catalog->getName() == "Shoes") : ?>
                                <aside class="aside-item filter-vendor">
                                    <div class="aside-title">
                                        <h2 class="title-head margin-top-0"><span>Lọc theo size</span></h2>
                                    </div>
                                    <div class="aside-content filter-group">

                                        <ul class="filter-size">

                                            <?php foreach ($modelVariantDetail->getListShoesSize() as $brand) : ?>
                                                <li class="filter-item filter-item--check-box filter-item--green ">
                                                    <label data-filter="filter-size-<?php echo $brand; ?>" for="filter-size-<?php echo $brand; ?>" class="size-<?php echo $brand; ?>">
                                                        <input type="checkbox" id="filter-size-<?php echo $brand; ?>" onchange="toggleFilter(this)" data-group="Size" data-field="size" data-text="<?php echo $brand; ?>" value="<?php echo $brand; ?>" data-operator="OR">
                                                        <i class="fa"></i>
                                                        <?php echo $brand; ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>


                                        </ul>
                                    </div>
                                </aside>
                            <?php elseif ($catalog->getName() == "String") : ?>

                            <?php elseif ($catalog->getName() == "Shuttle") : ?>
                                <aside class="aside-item filter-vendor">
                                    <div class="aside-title">
                                        <h2 class="title-head margin-top-0"><span>Tốc độ</span></h2>
                                    </div>
                                    <div class="aside-content filter-group">

                                        <ul class="filter-speed">

                                            <?php foreach ($modelVariantDetail->getListShuttleSpeed() as $brand) : ?>
                                                <li class="filter-item filter-item--check-box filter-item--green ">
                                                    <label data-filter="filter-speed-<?php echo $brand; ?>" for="filter-speed-<?php echo $brand; ?>" class="speed-<?php echo $brand; ?>">
                                                        <input type="checkbox" id="filter-speed-<?php echo $brand; ?>" onchange="toggleFilter(this)" data-group="Speed" data-field="speed" data-text="<?php echo $brand; ?>" value="<?php echo $brand; ?>" data-operator="OR">
                                                        <i class="fa"></i>
                                                        <?php echo $brand; ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>


                                        </ul>
                                    </div>
                                </aside>
                            <?php endif; ?>



                        </div>
                    </div>
                </div>
            </aside>

            <div class="block-collection">
                <div class="section-box-bg">
                    <h1 class="title-page d-md-block d-none">Vợt Cầu Lông</h1>
                    <div class="category-product">
                        <div id="sort-by">
                            <label class="left"><img width="16" height="16" alt="Sắp xếp" src="https://cdn.shopvnb.com/themes/images/sort.png">Sắp xếp: </label>
                            <ul id="sortBy">
                                <li><span id="keysort">Mặc định</span>
                                    <ul>
                                        <li><a href="javascript:;" onclick="sortby('alpha-asc')">A → Z</a></li>
                                        <li><a href="javascript:;" onclick="sortby('alpha-desc')">Z → A</a></li>
                                        <li><a href="javascript:;" onclick="sortby('price-asc')">Giá tăng dần</a></li>
                                        <li><a href="javascript:;" onclick="sortby('price-desc')">Giá giảm dần</a></li>
                                        <li><a href="javascript:;" onclick="sortby('created-desc')">Hàng mới nhất</a></li>
                                        <li><a href="javascript:;" onclick="sortby('created-asc')">Hàng cũ nhất</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="product-view" id="product">
                            <div class="nav-row" id="show-product">

                            </div>

                        </div>
                        <div class="content__paging">
                            <div class="page">
                                <ul>
                                    <li class="btn-prev btn-active fas fa-angle-left"></li>
                                    <div class="number-page" id="number-page">

                                    </div>
                                    <li class="btn-next fas fa-angle-right"></li>
                                </ul>
                            </div>
                            <div class="page-config" id="page-config">
                                <label for="">Item per page: </label>
                                <select name="" id="mySelect" onchange="loadPerPage()">
                                    <option value="3">3</option>
                                    <option value="6" selected>6</option>
                                    <option value="9">9</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="total-page"></div>
                            <div class="total-item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="filteredData"></div>
    </div>
</body>