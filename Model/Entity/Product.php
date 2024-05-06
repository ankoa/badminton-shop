<?php
class Product {
    public $productID;
    public $brandID;
    public $catalogID;
    public $name;
    public $timecreated;
    public $url;
    public $description;
    public $status;
    public $price;
    public $discount;

    public function __construct($productID, $brandID, $catalogID, $name, $description, $status, $price, $discount,$url) {

        $this->productID = $productID;
        $this->brandID = $brandID;
        $this->catalogID = $catalogID;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->price = $price;
        $this->discount = $discount;
        $this->url = $url;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }
    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->productID = $url;
    }

    public function getBrandID() {
        return $this->brandID;
    }

    public function setBrandID($brandID) {
        $this->brandID = $brandID;
    }

    public function getCatalogID() {
        return $this->catalogID;
    }

    public function setCatalogID($catalogID) {
        $this->catalogID = $catalogID;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }
}

?>
