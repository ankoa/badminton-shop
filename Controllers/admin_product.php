<?php
require_once (__DIR__ . '/../Model/ModelProduct.php');
require_once (__DIR__ . '/../Model/ModelBrand.php');
require_once (__DIR__ . '/../Model/ModelCatalog.php');
require_once (__DIR__ . '/../Model/ModelVariantDetail.php');
require_once (__DIR__ . '/../Model/ModelVariant.php');
$modelBrand = new ModelBrand();
$modelCatalog = new ModelBrand();
$modelVariant = new ModelBrand();
$modelVariantDetail = new ModelBrand();


function getImgList($productID) {
    $modelProduct = new ModelProduct();
    $product=$modelProduct->getProductByID($productID);
    $string = $product->getUrl();

    // Tạo mảng để lưu kết quả
    $result = array();

    // Tách chuỗi theo dấu chấm phẩy để lấy ra các phần tử riêng biệt
    $parts = explode(";", $string);

    foreach ($parts as $part) {
        // Tách từng phần tử thành tên và các số
        $temp = explode(":", $part);

        // Lưu tên làm key (viết thường) và các số làm value vào mảng kết quả
        if (isset($temp[0]) && isset($temp[1])) {
            $result[trim(($temp[0]))] = explode(",", $temp[1]);
        }
    }
    //$imagePaths = array_values($result)[0];
    return $result;
}
function delImg($productID, $imgIndex, $color) {
    $modelProduct = new ModelProduct();
    $product = $modelProduct->getProductByID($productID);
    $string = $product->getUrl();

    // Tạo mảng để lưu kết quả
    $result = array();

    // Tách chuỗi theo dấu chấm phẩy để lấy ra các phần tử riêng biệt
    $parts = explode(";", $string);

    foreach ($parts as $part) {
        // Tách từng phần tử thành tên và các số
        $temp = explode(":", $part);

        // Lưu tên làm key (viết thường) và các số làm value vào mảng kết quả
        if (isset($temp[0]) && isset($temp[1])) {
            $result[trim(($temp[0]))] = explode(",", $temp[1]);
        }
    }

    // Xóa phần tử có giá trị imgIndex trong mảng có key color
    $colorKey = trim(($color));
    if (isset($result[$colorKey])) {
        $imageArray = $result[$colorKey];
        // Sử dụng array_filter để xóa tất cả phần tử có giá trị bằng imgIndex
        $imageArray = array_filter($imageArray, function($value) use ($imgIndex) {
            return $value != $imgIndex;
        });
        // Sắp xếp lại mảng để đảm bảo các chỉ số liên tiếp (nếu cần)
        //$result[$colorKey] = array_values($imageArray);
    }

    // Tạo lại chuỗi URL từ mảng kết quả
    $newUrlArray = array();
    foreach ($result as $key => $values) {
        if (!empty($values)) { // Chỉ thêm vào nếu mảng không rỗng
            $newUrlArray[] = $key . ":" . implode(",", $values);
        }
    }
    $newUrlString = implode(";", $newUrlArray);

    // Cập nhật lại URL của sản phẩm
    $product->setUrl($newUrlString);
    $modelProduct->updateUrlImgProduct($productID, $newUrlString);

    // Trả về chuỗi URL mới
    return $newUrlString;
}

function addImg($productID, $imageURLs, $color) {
    $modelProduct = new ModelProduct();
    $product = $modelProduct->getProductByID($productID);
    $string = $product->getUrl();

    // Tạo mảng để lưu kết quả
    $result = array();

    // Tách chuỗi theo dấu chấm phẩy để lấy ra các phần tử riêng biệt
    $parts = explode(";", $string);

    foreach ($parts as $part) {
        // Tách từng phần tử thành tên và các số
        $temp = explode(":", $part);

        // Lưu tên làm key (viết thường) và các số làm value vào mảng kết quả
        if (isset($temp[0]) && isset($temp[1])) {
            $result[trim($temp[0])] = explode(",", $temp[1]);
        }
    }

    $colorKey = trim($color);

    if (isset($result[$colorKey])) {
        $imageArray = $result[$colorKey];
    } else {
        $imageArray = [];
    }

    // Thêm tất cả phần tử trong imageURLs vào mảng
    foreach ($imageURLs as $imgIndex) {
        $imageArray[] = $imgIndex;
    }

    // Cập nhật lại mảng con trong $result
    $result[$colorKey] = $imageArray;

    // Tạo lại chuỗi URL từ mảng kết quả
    $newUrlArray = array();
    foreach ($result as $key => $values) {
        if (!empty($values)) { // Chỉ thêm vào nếu mảng không rỗng
            $newUrlArray[] = $key . ":" . implode(",", $values);
        }
    }
    $newUrlString = implode(";", $newUrlArray);

    // Cập nhật lại URL của sản phẩm
    //$product->setUrl($newUrlString);
    //$modelProduct->updateUrlImgProduct($productID, $newUrlString);

    // Trả về chuỗi URL mới
    return $newUrlString;
}


if (isset($_GET['get'])) {
    if ($_GET['get']=='listImg') {
        if (isset($_GET['productID']))
            echo json_encode(getImgList($_GET['productID']));
    }
    else if ($_GET['get']=='delImg') {
        if (isset($_GET['productID']))
            if (isset($_GET['imgDel']))
                if (isset($_GET['color']))
                    echo json_encode(delImg($_GET['productID'], $_GET['imgDel'], $_GET['color']));
    } else if ($_GET['get']=='addImg') {
        if (isset($_GET['productID']))
            if (isset($_GET['imageURLs']))
                if (isset($_GET['color']))
                    echo json_encode(addImg($_GET['productID'], $_GET['imageURLs'], $_GET['color']));
    }
}
else {
    // Nếu không có dữ liệu được gửi, trả về một mảng trống dưới dạng chuỗi JSON
    echo json_encode([]);
}
?>