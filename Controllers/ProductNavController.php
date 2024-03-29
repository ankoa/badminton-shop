<?php
require_once(__DIR__ . '/../Model/ModelProduct.php');
require_once(__DIR__ . '/../Model/ModelBrand.php');
require_once(__DIR__ . '/../Model/ModelCatalog.php');
require_once(__DIR__ . '/../Model/ModelVariantDetail.php');
require_once(__DIR__ . '/../Model/ModelVariant.php');

$modelBrand=new ModelBrand();
$modelCatalog=new ModelBrand();
$modelProduct=new ModelBrand();
$modelVariant=new ModelBrand();
$modelVariantDetail=new ModelBrand();


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


function loadNav($productsPerPage, $id) {
    $id = intval($id);

    $totalProducts=0;
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
        if($catalog == $id){
            $totalProducts = $row['total_products']; 
            break;
        }
    }    

    $totalPages = ceil($totalProducts / $productsPerPage);
    $mysqli->close();
    
    return $totalPages;
}

function loadNavFilter($productsPerPage, $listProduct) {
    $totalPages = ceil(count($listProduct) / $productsPerPage);
    return $totalPages;
}


function findCommonProducts($list1, $list2) {
    // Chuyển mảng sản phẩm thành mảng chỉ chứa productID
    $productIDs1 = array_column($list1, 'productID');
    $productIDs2 = array_column($list2, 'productID');

    // Tìm giao của hai mảng dựa trên productID
    $intersection = array_intersect($productIDs1, $productIDs2);

    $commonProducts=[];

    foreach($intersection as $index) {
        foreach($list1 as $value) {
            if($value['productID']==$index) {
                $commonProducts[]=$value;
            }
        }
    }

    return $commonProducts;
}


// Kiểm tra nếu có dữ liệu được gửi từ yêu cầu AJAX
if (isset($_GET['page']) && isset($_GET['productsPerPage']) &&  isset($_GET['id'])) {
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
} else if (isset($_GET['filter'])) {
    $filterBrand = array();
    $filterPrice = array();
    $final = array();
    $selectedFilters = $_GET['selectedFilters'];
    $listProducts = loadPage(1, 12, 1);
    $thuong_hieu=[];
    $gia=[];
    if (isset($selectedFilters['thuong_hieu'])) {
        $thuong_hieu = $selectedFilters['thuong_hieu'];
    }
    if (isset($selectedFilters['gia'])) {
        $gia = $selectedFilters['gia'];
    }
    // Kiểm tra và lấy giá trị của 'thuong_hieu'
    if (count($thuong_hieu)!=0) {
        foreach ($listProducts as $key => $product) {
            foreach ($thuong_hieu as $value) {
                if ($product['brandID'] == $value) {
                    $filterBrand[]= $product;
                }
            }
        }
        if(count($filterBrand)>0) $final=$filterBrand;
    }
    
    // Lọc theo giá
    if (count($gia)!=0) {
        foreach ($listProducts as $key => $product) {
            foreach ($gia as $value) {
                $parts = explode("-", $value);
                if ($parts[1] == 0) {
                    if ($product['price'] >= $parts[0]) {
                        $filterPrice[]= $product;
                    }
                } else {
                    if ($product['price'] >= $parts[0] && $product['price'] < $parts[1]) {
                        $filterPrice[]= $product;
                    }
                }
            }
        }
        if(count($filterBrand)>0) $final=findCommonProducts($filterBrand,$filterPrice);
        else $final=$filterPrice;
    }

    
    
   

    // Chuyển đổi dữ liệu thành chuỗi JSON để trả về cho JavaScript
    $jsonData = json_encode($final);

    // In ra kết quả lọc được từ JavaScript
    echo "<div>Kết quả nhận được từ JavaScript (data group 'brand'): $jsonData</div>";
} else {
    // Nếu không có dữ liệu được gửi, trả về một mảng trống dưới dạng chuỗi JSON
    echo json_encode([]);
}
?>
