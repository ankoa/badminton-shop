<?php

require_once 'Database.php';
require_once 'String.php'; // Import Entity String

class ModelString {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các string từ cơ sở dữ liệu
    public function getAllStrings() {
        $query = "SELECT * FROM `string` WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $strings = [];
            while ($row = $result->fetch_assoc()) {
                $string = new String($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
                $strings[] = $string;
            }
            return $strings;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin một string bằng ID
    public function getStringByID($productID) {
        $query = "SELECT * FROM `string` WHERE `productID` = '$productID' AND status != 0";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $string = new String($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
            return $string;
        } else {
            return false;
        }
    }

    // Phương thức để thêm một string mới vào cơ sở dữ liệu
    public function addString($color, $price, $discount, $status, $quantity, $country, $note, $list_image) {
        $query = "INSERT INTO `string` (`color`, `price`, `discount`, `status`, `quantity`, `country`, `note`, `list_image`) 
                  VALUES ('$color', '$price', '$discount', '$status', '$quantity', '$country', '$note', '$list_image')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin của một string trong cơ sở dữ liệu
    public function updateString($productID, $color, $price, $discount, $status, $quantity, $country, $note, $list_image) {
        $query = "UPDATE `string` 
                  SET `color` = '$color', `price` = '$price', `discount` = '$discount', `status` = '$status', 
                      `quantity` = '$quantity', `country` = '$country', `note` = '$note', `list_image` = '$list_image' 
                  WHERE `productID` = '$productID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một string khỏi cơ sở dữ liệu
    public function deleteString($productID) {
        $query = "UPDATE FROM `string` SET status=0 WHERE `productID` = '$productID'";
        return $this->db->delete($query);
    }

    // Phương thức để tìm kiếm string theo màu sắc
    public function searchStringsByColor($color) {
        $query = "SELECT * FROM `string` WHERE `color` = '$color'";
        $result = $this->db->select($query);
        if ($result) {
            $strings = [];
            while ($row = $result->fetch_assoc()) {
                $string = new String($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
                $strings[] = $string;
            }
            return $strings;
        } else {
            return false;
        }
    }

    // Phương thức để tìm kiếm string theo giá
    public function searchStringsByPriceRange($minPrice, $maxPrice) {
        $query = "SELECT * FROM `string` WHERE `price` >= '$minPrice' AND `price` <= '$maxPrice'";
        $result = $this->db->select($query);
        if ($result) {
            $strings = [];
            while ($row = $result->fetch_assoc()) {
                $string = new String($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
                $strings[] = $string;
            }
            return $strings;
        } else {
            return false;
        }
    }
}

?>