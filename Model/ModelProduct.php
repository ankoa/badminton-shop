<?php

require_once 'Database.php';

class ModelProduct {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    // Phương thức để lấy tất cả sản phẩm từ cơ sở dữ liệu
    public function getAllProducts() {
        $query = "SELECT * FROM product";
        $result = $this->db->select($query);
        if ($result) {
            $product = [];
            while ($row = $result->fetch_assoc()) {
                $product[] = $row;
            }
            return $product;
        } else {
            return false;
        }
    }
    // Phương thức để lấy thông tin người dùng bằng ID
    public function getProductByID($productID) {
        $query = "SELECT * FROM product WHERE productID = '$productID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin sản phẩm bằng atalogID
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
}

?>