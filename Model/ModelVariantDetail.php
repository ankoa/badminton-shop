<?php

require_once 'database.php';
require_once(__DIR__ . '/Entity/VariantDetail.php');

class ModelVariantDetail {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    

    // Phương thức để lấy tất cả các biến thể từ cơ sở dữ liệu
    public function getAllVariantsDetail() {
        $query = "SELECT * FROM variantdetail WHERE status != 0";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variant = new VariantDetail(
                    $row['productID'],
                    $row['color'],
                    $row['size'],
                    $row['speed'],
                    $row['grip'],
                    $row['weight'],
                    $row['quantity'],
                    $row['list_image'],
                    $row['status']
                );
                $variants[] = $variant;
            }
        }
        return $variants;
    }
    

    public function getListVariantsByID($variantID) {
        $query = "SELECT * FROM variantdetail WHERE variantID = '$variantID' AND status != 0";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variant = new VariantDetail(
                    $row['productID'],
                    $row['color'],
                    $row['size'],
                    $row['speed'],
                    $row['grip'],
                    $row['weight'],
                    $row['quantity'],
                    $row['list_image'],
                    $row['status']
                );
                $variants[] = $variant;
            }
        }
        return $variants;
    }

    
    // Phương thức để lấy một biến thể theo ID
    public function getVariantByID($variantID) {
        $query = "SELECT * FROM variantdetail WHERE variantID = '$variantID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
            $variant = new VariantDetail(
                $row['variantID'],
                $row['color'],
                $row['size'],
                $row['speed'],
                $row['grip'],
                $row['weight'],
                $row['quantity'],
                $row['list_image'],
                $row['status']
            );
            return $variant;
        } else {
            return null;
        }
    }

    public function getVariantQuantityByColor($listVariant,$color) {
        $quantity=0;
        foreach($listVariant as $variant):
            if($variant->getColor()==$color):
                $quantity+=$variant->getQuantity();
            endif;
        endforeach;
        return $quantity;
    }

    // Phương thức để thêm một biến thể vào cơ sở dữ liệu
    public function addVariant($variant) {
        $variantID = $variant->getVariantID();
        $color = $variant->getColor();
        $size = $variant->getSize();
        $speed = $variant->getSpeed();
        $grip = $variant->getGrip();
        $weight = $variant->getWeight();
        $quantity = $variant->getQuantity();
        $listImage = $variant->getListImage();
        $status = $variant->getStatus();

        $query = "INSERT INTO variantdetail (variantID, color, size, speed, grip, weight, quantity, list_image, status) 
                  VALUES ('$variantID', '$color', '$size', '$speed', '$grip', '$weight', '$quantity', '$listImage', '$status')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin biến thể trong cơ sở dữ liệu
    public function updateVariant($variant) {
        $variantID = $variant->getVariantID();
        $color = $variant->getColor();
        $size = $variant->getSize();
        $speed = $variant->getSpeed();
        $grip = $variant->getGrip();
        $weight = $variant->getWeight();
        $quantity = $variant->getQuantity();
        $listImage = $variant->getListImage();
        $status = $variant->getStatus();

        $query = "UPDATE variantdetail 
                  SET color = '$color', 
                      size = '$size', 
                      speed = '$speed', 
                      grip = '$grip', 
                      weight = '$weight', 
                      quantity = '$quantity', 
                      list_image = '$listImage', 
                      status = '$status' 
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một biến thể khỏi cơ sở dữ liệu
    public function deleteVariant($variantID) {
        $query = "UPDATE variantdetail SET status = 0 WHERE variantID = '$variantID'";
        return $this->db->delete($query);
    }
}

?>
