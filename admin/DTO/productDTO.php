<?php 
    class productDTO
    {
        private $productID;
        private $brandID;
        private $catalogID;
        private $name;
        private $urlAvatar;
      
      public function __construct($productID, $brandID, $catalogID, $name, $urlAvatar)
      {

        $this->productID = $productID;
        $this->brandID = $brandID;
        $this->catalogID = $catalogID;
        $this->name = $name;
        $this->urlAvatar = $urlAvatar;
      }

      

      function toString() {
          return($this->last_name .", " .$this->first_name.",".$this->age);
       }
    }
    $p=new Person("Sang", "Thanh", 25);


?>