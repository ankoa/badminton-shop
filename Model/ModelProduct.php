<?php
require_once 'database.php';

require_once(__DIR__ . '/Entity/Product.php');


class ModelProduct
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Lấy tất cả sản phẩm từ cơ sở dữ liệu
    public function getAllProducts()
    {
        $query = "SELECT * FROM product";
        $result = $this->db->select($query);

        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }

        return $products;
    }

    public function getListProductBySpeed($speed)
    {
        $query = "SELECT *
        FROM product p, variantdetail vd, variant v
        WHERE p.productID=v.productID and v.variantID=vd.variantID and vd.speed=$speed";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }
        return $products;
    }

    public function getListProductBySize($size)
    {
        $query = "SELECT *
        FROM product p, variantdetail vd, variant v
        WHERE p.productID=v.productID and v.variantID=vd.variantID and vd.size=$size";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }
        return $products;
    }

    public function getListProductByWeight($weight)
{
    $query = "SELECT DISTINCT p.productID, p.brandID, p.catalogID, p.name, p.description, p.status, p.price, p.discount, p.url_image, p.timeCreated
    FROM product p, variantdetail vd, variant v
    WHERE p.productID=v.productID and v.variantID=vd.variantID and vd.weight='$weight'";
    
    $result = $this->db->select($query);
    $products = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row['productID'],
                $row['brandID'],
                $row['catalogID'],
                $row['name'],
                $row['description'],
                $row['status'],
                $row['price'],
                $row['discount'],
                $row['url_image'],
                $row['timeCreated']
            );
            $products[] = $product;
        }
    }
    
    return $products;
}


    public function getListProductByColor($color)
    {
        $query = "SELECT *
        FROM product p, variantdetail vd, variant v
        WHERE p.productID=v.productID and v.variantID=vd.variantID and p.catalogID=2 and vd.color='$color'";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }
        return $products;
    }

    public function getListProductByGrip($grip)
{
    $query = "SELECT DISTINCT p.productID, p.brandID, p.catalogID, p.name, p.description, p.status, p.price, p.discount, p.url_image, p.timeCreated
        FROM product p, variantdetail vd, variant v
        WHERE p.productID=v.productID and v.variantID=vd.variantID and vd.grip='$grip'";
    $result = $this->db->select($query);
    $products = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row['productID'],
                $row['brandID'],
                $row['catalogID'],
                $row['name'],
                $row['description'],
                $row['status'],
                $row['price'],
                $row['discount'],
                $row['url_image'],
                $row['timeCreated']
            );
            $products[] = $product;
        }
    }
    return $products;
}


    // Lấy thông tin sản phẩm dựa trên ID
    public function getProductByID($productID)
    {
        $query = "SELECT * FROM product WHERE productID = '$productID'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product = new Product(
                $row['productID'],
                $row['brandID'],
                $row['catalogID'],
                $row['name'],
                $row['description'],
                $row['status'],
                $row['price'],
                $row['discount'],
                $row['url_image'],
                $row['timeCreated']
            );
            return $product;
        }

        return null;
    }

    public function getProductByCode($ProductID)
    {
        $query = "SELECT * FROM product JOIN ordertransaction ON product.productID = ordertransaction.productID 
                    WHERE ordertransaction.productID = '$ProductID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin sản phẩm bằng catalogID
    public function getProductByCatalogID($catalogID)
    {
        $query = "SELECT * FROM product WHERE catalogID = '$catalogID'";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }
        return $products;
    }

    // Phương thức để lấy thông tin sản phẩm bằng brandID
    public function getProductByBrandID($brandID)
    {
        $query = "SELECT * FROM product WHERE brandID = '$brandID'";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }
        return $products;
    }

    public function getProductByBrandIDAndCatalogID($catalogID, $brandID)
    {
        $query = "SELECT * FROM product WHERE brandID = '$brandID' AND catalogID = '$catalogID'";
        $result = $this->db->select($query);
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['productID'],
                    $row['brandID'],
                    $row['catalogID'],
                    $row['name'],
                    $row['description'],
                    $row['status'],
                    $row['price'],
                    $row['discount'],
                    $row['url_image'],
                    $row['timeCreated']
                );
                $products[] = $product;
            }
        }
        return $products;
    }

    // Phương thức để lấy thông tin sản phẩm bằng name
    public function getProductByName($name)
    {
        $query = "SELECT * FROM product WHERE name = '$name'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Thêm sản phẩm mới vào cơ sở dữ liệu
    // public function addProduct($product)
    // {
    //     $productID = $product->getProductID();
    //     $brandID = $product->getBrandID();
    //     $catalogID = $product->getCatalogID();
    //     $name = $product->getName();

    //     $description = $product->getDescription();

    //     $query = "INSERT INTO product (productID, brandID, catalogID, name, description) VALUES ('$productID', '$brandID', '$catalogID', '$name', '$urlAvatar')";

    //     return $this->db->insert($query);
    // }

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    public function updateProduct($product)
    {
        $productID = $product->getProductID();
        $brandID = $product->getBrandID();
        $catalogID = $product->getCatalogID();
        $name = $product->getName();
        $description = $product->getDescription();

        $query = "UPDATE product SET brandID = '$brandID', catalogID = '$catalogID', name = '$name', description = '$description' WHERE productID = '$productID'";
        return $this->db->update($query);
    }

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    public function deleteProduct($productID)
    {
        $query = "DELETE FROM product WHERE productID = '$productID'";
        return $this->db->delete($query);
    }
    public function searchProductsByName($searchString)
{
    $query = "SELECT * FROM product WHERE name LIKE '%$searchString%'";
    $result = $this->db->select($query);
    $products = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row['productID'],
                $row['brandID'],
                $row['catalogID'],
                $row['name'],
                $row['description'],
                $row['status'],
                $row['price'],
                $row['discount'],
                $row['url_image']
            );
            $products[] = $product;
        }
    }
    return $products;
}

}
