<?php

require_once 'Database.php';
require_once 'Brand.php';

class ModelBrand {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các thương hiệu từ cơ sở dữ liệu
    public function getAllBrands() {
        $query = "SELECT * FROM brand WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $brands = [];
            while ($row = $result->fetch_assoc()) {
                $brands[] = new Brand($row['brandID'], $row['name'], $row['description'], $row['status']);
            }
            return $brands;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin thương hiệu bằng ID
    public function getBrandByID($brandID) {
        $query = "SELECT * FROM brand WHERE brandID = '$brandID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return new Brand($row['brandID'], $row['name'], $row['description'], $row['status']);
        } else {
            return false;
        }
    }

    // Phương thức để thêm một thương hiệu mới vào cơ sở dữ liệu
    public function addBrand($name, $description, $status) {
        $query = "INSERT INTO brand (name, description, status) VALUES ('$name', '$description', '$status')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin thương hiệu trong cơ sở dữ liệu
    public function updateBrand($brandID, $name, $description, $status) {
        $query = "UPDATE brand SET name = '$name', description = '$description', status = '$status' WHERE brandID = '$brandID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một thương hiệu khỏi cơ sở dữ liệu (chỉ đặt trạng thái thành 0)
    public function deleteBrand($brandID) {
        $query = "UPDATE brand SET status = 0 WHERE brandID = '$brandID'";
        return $this->db->update($query);
    }
}

?>
