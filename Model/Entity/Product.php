<?php
class Product {
    public $productID;
    public $brandID;
    public $catalogID;
    public $name;
    public $urlAvatar;

    public function __construct($productID, $brandID, $catalogID, $name, $urlAvatar) {
        $this->productID = $productID;
        $this->brandID = $brandID;
        $this->catalogID = $catalogID;
        $this->name = $name;
        $this->urlAvatar = $urlAvatar;
    }
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
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

    public function getUrlAvatar() {
        return $this->urlAvatar;
    }

    public function setUrlAvatar($urlAvatar) {
        $this->urlAvatar = $urlAvatar;
    }
}

?>
