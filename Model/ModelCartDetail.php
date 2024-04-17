<?php
require_once 'database.php';
require_once(__DIR__ . '/Entity/CartDetail.php');
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
    public function getCartDetailByCartID($cartID) {
        $query = "SELECT * FROM cartdetail WHERE cartID = '$cartID'";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new CartDetail(
                    $row['cartDetailID'],
                    $row['cartID'],
                    $row['productID'],
                    $row['variantID'],
                    $row['quantity'],
                    $row['price'],
                );
                $products[] = $product;
            }
        }

        return $products;
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
    public function addCartDetail($cartID, $productID, $variantID, $quantity, $price) {
        $query = "INSERT INTO cartdetail (cartID, productID, variantID, quantity, price) 
                  VALUES ('$cartID', '$productID', '$variantID', '$quantity', '$price')";
        return $this->db->insert($query);
    }

    public function checkCartDetail($productID, $variantID) {
        $query = "SELECT * FROM cartdetail WHERE productID = '$productID' AND variantID = '$variantID'";
        $result = $this->db->select($query);
        if ($result) {
            $cartDetails = [];
            while ($row = $result->fetch_assoc()) {
                $cartDetails[] = $row;
            }
            if(count($cartDetails) > 0) return true;
            else return false;
        } else {
            return false;
        }
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
