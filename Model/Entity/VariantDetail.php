<?php

class VariantDetail {
    protected $variantID;
    protected $color;
    protected $size;
    protected $speed;
    protected $grip;
    protected $weight;
    protected $quantity;
    protected $list_image;
    protected $status;

    public function __construct($variantID, $color, $size, $speed, $grip, $weight, $quantity, $list_image, $status) {
        $this->variantID = $variantID;
        $this->color = $color;
        $this->size = $size;
        $this->speed = $speed;
        $this->grip = $grip;
        $this->weight = $weight;
        $this->quantity = $quantity;
        $this->list_image = $list_image;
        $this->status = $status;
    }

    public function getVariantID() {
        return $this->variantID;
    }

    public function getColor() {
        return $this->color;
    }

    public function getSize() {
        return $this->size;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function getGrip() {
        return $this->grip;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getListImage() {
        return $this->list_image;
    }

    public function getStatus() {
        return $this->status;
    }
}

?>
