<?php
require_once 'database.php';
require_once '..\Model\Entity\CartDetail.php';
class ModelCartDetail {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các chi tiết giỏ hàng từ cơ sở dữ liệu
    public function getAllCartDetails() {
        $query = "SELECT * FROM cartdetail";
        $result = $this->db->select($query);
        if ($result) {
            $cartDetails = [];
            while ($row = $result->fetch_assoc()) {
                $cartDetails[] = $row;
            }
            return $cartDetails;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin chi tiết giỏ hàng bằng ID
    public function getCartDetailByID($cartDetailID) {
        $query = "SELECT * FROM cartdetail WHERE cartDetailID = '$cartDetailID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để thêm một chi tiết giỏ hàng mới vào cơ sở dữ liệu
    public function addCartDetail($cartID, $productID, $quantity, $price) {
        $query = "INSERT INTO cartdetail (cartID, productID, quantity, price) 
                  VALUES ('$cartID', '$productID', '$quantity', '$price')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin chi tiết giỏ hàng trong cơ sở dữ liệu
    public function updateCartDetail($cartDetailID, $cartID, $productID, $quantity, $price) {
        $query = "UPDATE cartdetail 
                  SET cartID = '$cartID', 
                      productID = '$productID', 
                      quantity = '$quantity', 
                      price = '$price' 
                  WHERE cartDetailID = '$cartDetailID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một chi tiết giỏ hàng khỏi cơ sở dữ liệu
    public function deleteCartDetail($cartDetailID) {
        $query = "DELETE FROM cartdetail WHERE cartDetailID = '$cartDetailID'";
        return $this->db->delete($query);
    }
}

?>
