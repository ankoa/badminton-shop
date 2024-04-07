<?php
require_once(__DIR__ . '/../Model/ModelProduct.php');
require_once(__DIR__ . '/../Model/ModelBrand.php');
require_once(__DIR__ . '/../Model/ModelCatalog.php');
require_once(__DIR__ . '/../Model/ModelVariantDetail.php');
require_once(__DIR__ . '/../Model/ModelVariant.php');

$modelBrand = new ModelBrand();
$modelCatalog = new ModelBrand();

$modelVariant = new ModelBrand();
$modelVariantDetail = new ModelBrand();

function getAll($id)
{
    $mysqli = new mysqli("localhost", "root", "", "badmintonweb");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $strSQL = "SELECT * FROM  product 
    WHERE catalogID= $id";

    $result = $mysqli->query($strSQL); // Thực thi truy vấn SQL

    $variantsArray = [];
    if ($result) {
        while ($variant = $result->fetch_assoc()) {
            $variantsArray[] = array(
                'productID' => $variant['productID'],
                'brandID' => $variant['brandID'],
                'catalogID' => $variant['catalogID'],
                'name' => $variant['name'],
                'price' => $variant['price'],
                'discount' => $variant['discount'],
                'status' => $variant['status'],
            );
        }
        $result->close(); // Đóng kết quả truy vấn
    }

    $mysqli->close();
    return $variantsArray; // Trả về mảng kết quả
}

function loadPage($page, $productsPerPage, $id)
{
    $mysqli = new mysqli("localhost", "root", "", "badmintonweb");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $offset = ($page - 1) * $productsPerPage;
    $strSQL = "SELECT * FROM (
    SELECT *, ROW_NUMBER() OVER() AS row_num 
    FROM product 
    WHERE catalogID= $id
    ) AS numbered_rows
    ORDER BY row_num
    LIMIT $offset, $productsPerPage";

    $result = $mysqli->query($strSQL); // Thực thi truy vấn SQL

    $variantsArray = [];
    if ($result) {
        while ($variant = $result->fetch_assoc()) {
            $variantsArray[] = array(
                'productID' => $variant['productID'],
                'brandID' => $variant['brandID'],
                'catalogID' => $variant['catalogID'],
                'name' => $variant['name'],
                'price' => $variant['price'],
                'discount' => $variant['discount'],
                'status' => $variant['status'],
            );
        }
        $result->close(); // Đóng kết quả truy vấn
    }

    $mysqli->close();
    return $variantsArray; // Trả về mảng kết quả
}

function loadPageFilter($page, $productsPerPage, $listProduct)
{
    $offset = ($page - 1) * $productsPerPage;
    $productsOnCurrentPage = array_slice($listProduct, $offset, $productsPerPage);
    return $productsOnCurrentPage;
}


function loadNav($productsPerPage, $id)
{
    $id = intval($id);

    $totalProducts = 0;
    $mysqli = new mysqli("localhost", "root", "", "badmintonweb");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $strSQL = "SELECT catalogID, COUNT(*) AS total_products
    FROM product
    GROUP BY catalogID";
    $result = $mysqli->query($strSQL);
    while ($row = $result->fetch_assoc()) {
        // Lấy giá trị của cột 'name' từ mỗi hàng kết quả
        $catalog = $row['catalogID'];
        if ($catalog == $id) {
            $totalProducts = $row['total_products'];
            break;
        }
    }

    $totalPages = ceil($totalProducts / $productsPerPage);
    $mysqli->close();

    return $totalPages;
}

function loadNavFilter($productsPerPage, $listProduct)
{
    $totalPages = ceil(count($listProduct) / $productsPerPage);
    return $totalPages;
}


function findCommonProducts($list1, $list2)
{
    // Chuyển mảng sản phẩm thành mảng chỉ chứa productID
    $productIDs1 = array_column($list1, 'productID');
    $productIDs2 = array_column($list2, 'productID');

    // Tìm giao của hai mảng dựa trên productID
    $intersection = array_intersect($productIDs1, $productIDs2);

    $commonProducts = [];

    foreach ($intersection as $index) {
        foreach ($list1 as $value) {
            if ($value->getProductID() == $index) {
                $commonProducts[] = $value;
            }
        }
    }

    return $commonProducts;
}

function mergeArrays($array1, $array2) {
    $mergedArray = $array1;
    foreach ($array2 as $key => $value) {
        // Kiểm tra nếu productID đã tồn tại trong mảng 1
        if (isset($array1['productID']) && $array1['productID'] === $value['productID']) {
            // Nếu trùng productID thì không hợp nhất
            continue;
        }
        // Thêm phần tử vào mảng 1 nếu không trùng productID
        $mergedArray[$key] = $value;
    }
    return $mergedArray;
}


// Kiểm tra nếu có dữ liệu được gửi từ yêu cầu AJAX
if (isset($_GET['filter']) && isset($_GET['selectedFilters'])) {
    $filterBrand = array();
    $filterPrice = array();
    $filterWeight = array();
    $filterGrip = array();
    $filterSize = array();
    $filterSpeed = array();
    $filterColor = array();
    $final = array();
    $selectedFilters = $_GET['selectedFilters'];
    $id = $_GET['id'];
    $modelProduct = new ModelProduct();
    $listProducts = $modelProduct->getProductByCatalogID($id);
    $thuong_hieu = [];
    $color = [];
    $speed = [];
    $gia = [];
    $weight = [];
    $grip = [];
    $size = [];
    if (isset($selectedFilters['thuong_hieu'])) {
        $thuong_hieu = $selectedFilters['thuong_hieu'];
    }
    if (isset($selectedFilters['gia'])) {
        $gia = $selectedFilters['gia'];
    }
    if (isset($selectedFilters['speed'])) {
        $speed = $selectedFilters['speed'];
    }
    if (isset($selectedFilters['color'])) {
        $color = $selectedFilters['color'];
    }
    if (isset($selectedFilters['weight'])) {
        $weight = $selectedFilters['weight'];
    }
    if (isset($selectedFilters['grip'])) {
        $grip = $selectedFilters['grip'];
    }
    if (isset($selectedFilters['size'])) {
        $size = $selectedFilters['size'];
    }
    // Kiểm tra và lấy giá trị của 'thuong_hieu'
    if (count($thuong_hieu) != 0) {
        foreach ($listProducts as $key => $product) {
            foreach ($thuong_hieu as $value) {
                if ($product->getBrandID() == $value) {
                    $filterBrand[] = $product;
                }
            }
        }
        if (count($filterBrand) > 0) $final = $filterBrand;
    }

    // Lọc theo giá
    if (count($gia) != 0) {
        foreach ($listProducts as $key => $product) {
            foreach ($gia as $value) {
                $parts = explode("-", $value);
                if ($parts[1] == 0) {
                    if ($product->getPrice() >= $parts[0]) {
                        $filterPrice[] = $product;
                    }
                } else {
                    if ($product->getPrice() >= $parts[0] && $product->getPrice() < $parts[1]) {
                        $filterPrice[] = $product;
                    }
                }
            }
        }
        if (count($final) > 0) $final = findCommonProducts($final, $filterPrice);
        else $final = $filterPrice;
    }

    // Lọc theo tốc độ
    if (count($speed) != 0) {
        $modelProduct = new $modelProduct();
        

        foreach ($speed as $value) {
            $listSpeed = $modelProduct->getListProductBySpeed($value);
            $filterSpeed= mergeArrays($filterSpeed,$listSpeed);
        }

        if (count($final) > 0) $final = findCommonProducts($final, $filterSpeed);
        else $final = $filterSpeed;
    }

    // Lọc theo size
    if (count($size) != 0) {
        $modelProduct = new $modelProduct();
        

        foreach ($size as $value) {
            $listSize = $modelProduct->getListProductBySize($value);
            $filterSize= mergeArrays($filterSize,$listSize);
        }

        if (count($final) > 0) $final = findCommonProducts($final, $filterSize);
        else $final = $filterSize;
    }

    // Lọc theo weight
    if (count($weight) != 0) {
        $modelProduct = new $modelProduct();
        

        foreach ($weight as $value) {
            $listWeight = $modelProduct->getListProductByWeight($value);
            $filterWeight= mergeArrays($filterWeight,$listWeight);
        }

        if (count($final) > 0) $final = findCommonProducts($final, $filterWeight);
        else $final = $filterWeight;
    }

    // Lọc theo grip
    if (count($grip) != 0) {
        $modelProduct = new $modelProduct();
        

        foreach ($grip as $value) {
            $listGrip = $modelProduct->getListProductBySize($value);
            $filterGrip= mergeArrays($filterGrip,$listGrip);
        }

        if (count($final) > 0) $final = findCommonProducts($final, $filterGrip);
        else $final = $filterGrip;
    }

    // Lọc theo color
    if (count($color) != 0) {
        $modelProduct = new $modelProduct();
        

        foreach ($color as $value) {
            $listColor = $modelProduct->getListProductByColor($value);
            $filterColor= mergeArrays($filterColor,$listColor);
        }

        if (count($final) > 0) $final = findCommonProducts($listColor, $filterColor);
        else $final = $filterColor;
    }

    



    // Chuyển đổi dữ liệu thành chuỗi JSON để trả về cho JavaScript
    $jsonData = json_encode($final);

    // In ra kết quả lọc được từ JavaScript
    echo $jsonData;
} else if (isset($_GET['page']) && isset($_GET['productsPerPage']) &&  isset($_GET['id'])) {
    $page = $_GET['page'];
    $id = $_GET['id'];
    $productsPerPage = $_GET['productsPerPage'];
    $listVariantDetails = loadPage($page, $productsPerPage, $id);
    echo json_encode($listVariantDetails); // Chuyển đổi thành chuỗi JSON và echo ra
} else if (isset($_GET['productsPerPage']) && isset($_GET['id'])) {
    $productsPerPage = $_GET['productsPerPage'];
    $id = $_GET['id'];
    $listVariantDetails = loadNav($productsPerPage, $id);
    echo json_encode($listVariantDetails); // Chuyển đổi thành chuỗi JSON và echo ra
} else if (isset($_GET['getAll'])) {
    $id = $_GET['id'];
    $list = getAll($id);
    echo json_encode($list);
} else {
    // Nếu không có dữ liệu được gửi, trả về một mảng trống dưới dạng chuỗi JSON
    echo json_encode([]);
}
