<?php
require_once 'database.php';
require_once '..\Model\Entity\Product.php';
class ModelProduct {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lấy tất cả sản phẩm từ cơ sở dữ liệu
    public function getAllProducts() {
        $query = "SELECT * FROM product";
        $result = $this->db->select($query);

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['urlAvatar']
                );
                $products[] = $product;
            }
        }

        return $products;
    }

    // Lấy thông tin sản phẩm dựa trên ID
    public function getProductByID($productID) {
        $query = "SELECT * FROM product WHERE productID = '$productID'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product = new Product(
                $row['productID'],
                $row['brandID'],
                $row['catalogID'],
                $row['name'],
                $row['urlAvatar']
            );
            return $product;
        }

        return null;
    }

    // Phương thức để lấy thông tin sản phẩm bằng catalogID
    public function getProductByCatalogID($catalogID) {
        $query = "SELECT * FROM product WHERE catalogID = '$catalogID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin sản phẩm bằng brandID
    public function getProductByBrandID($brandID) {
        $query = "SELECT * FROM product WHERE brandID = '$brandID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin sản phẩm bằng name
    public function getProductByName($name) {
        $query = "SELECT * FROM product WHERE name = '$name'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Thêm sản phẩm mới vào cơ sở dữ liệu
    public function addProduct($product) {
        $productID = $product->getProductID();
        $brandID = $product->getBrandID();
        $catalogID = $product->getCatalogID();
        $name = $product->getName();
        $urlAvatar = $product->getUrlAvatar();

        $query = "INSERT INTO product (productID, brandID, catalogID, name, urlAvatar) VALUES ('$productID', '$brandID', '$catalogID', '$name', '$urlAvatar')";
        return $this->db->insert($query);
    }

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    public function updateProduct($product) {
        $productID = $product->getProductID();
        $brandID = $product->getBrandID();
        $catalogID = $product->getCatalogID();
        $name = $product->getName();
        $urlAvatar = $product->getUrlAvatar();

        $query = "UPDATE product SET brandID = '$brandID', catalogID = '$catalogID', name = '$name', urlAvatar = '$urlAvatar' WHERE productID = '$productID'";
        return $this->db->update($query);
    }

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    public function deleteProduct($productID) {
        $query = "DELETE FROM product WHERE productID = '$productID'";
        return $this->db->delete($query);
    }
}

?>

