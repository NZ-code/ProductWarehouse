<?php
class Database{
    private $conn;
    private static $instance = null;
    private function __construct() {
        $this->connect();
    }
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }
    private function connect(){
        $servername = "localhost";
        $username = "nick";
        $password = "123";
        $databaseName = "shop";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $databaseName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->conn = $conn;
    }
    public function addProduct($product){    
        $name = $product->getName();
        $sku = $product->getSku();
        $price = $product->getPrice();
        $type = $product->getType();
        $addProductQuery = 'INSERT INTO PRODUCT(name, sku, price, type)
        VALUES(?, ?, ?, ?);';
        $this->executeQuery($addProductQuery, [$name,$sku,$price, $type]);
        // fetching product from database to get it's id(generated in database);
        $productFromDatabase = $this->getProductBySku($sku);
        $product->setId($productFromDatabase->getId());
        $this->addProductProperties($product);    
    }
    
    private function getProductBySku($sku){
        $getProductBySkuQuery = 'SELECT * FROM PRODUCT WHERE SKU = ?;';
        $productRow = $this->executeQuery($getProductBySkuQuery, [$sku])->fetch_assoc();
        $product = $this->createProductFromRow($productRow);
        return $product;
    }
    private function addProductProperties($product){
        $productId = $product->getId();
        $properties = $product->getSpecificProperties();
        foreach ($properties as $propertyName => $value) {
            $propetyId = $this->getPropertyIdByName($propertyName);
            if($propetyId==-1){
                continue;
            }
            
            $productPropertyQuery = 'INSERT INTO PRODUCT_PROPERTY(product_id, property_id, value) 
            VALUE (?,?, ?);';
        
            $this->executeQuery($productPropertyQuery, [$productId, $propetyId, $value]);
        }
    }
    private function getPropertyIdByName($propertyName){
        
        $getPropertyByName = 'SELECT * FROM PROPERTY WHERE NAME = ?;';
        $propertyRow = $this->executeQuery($getPropertyByName, [$propertyName])->fetch_assoc();
        if(!isset($propertyRow)) return -1;
        return $propertyRow['id'];
    }
    
    
    public function getProducts(){
        $products = [];
        $getProductsQuery = 'SELECT * FROM PRODUCT;';
        $productRows = $this->executeQuery($getProductsQuery);
        if ($productRows->num_rows > 0) {
            while($row = $productRows->fetch_assoc()) {
                $product = $this->createProductFromRow($row);
                $productSpecificProperties = $this->getProductSpecificProperties($product);
                
                $product->setSpecificProperties($productSpecificProperties);
                array_push($products, $product);
            }
        }
        return $products;
    }
    private function getProductSpecificProperties($product){
        $properties = [];
        $productId = $product->getId();
        $getProductPropertiesQuery = 'SELECT PROPERTY.name, PRODUCT_PROPERTY.value FROM PRODUCT_PROPERTY JOIN PROPERTY on PRODUCT_PROPERTY.property_id = PROPERTY.id where product_id = ?;';
        $propertiesRows = $this->executeQuery($getProductPropertiesQuery, [$productId]);
       
        if ($propertiesRows->num_rows > 0) {
            while($row = $propertiesRows->fetch_assoc()) {
                
                $propertyName = $row['name'];
                $propertyValue = $row['value'];
                $properties[$propertyName] = $propertyValue;
            }
        }
   
        return $properties;

    }
    private function createProductFromRow($row){
        $id = $row['id'];
        $type = $row['type'];
        $name = $row['name'];
        $sku = $row['sku'];
        $price = $row['price'];

        
        $productFactory = new ProductFactory();
        $product = $productFactory->createProduct($type, $name, $price, $sku);
        $product->setId($id);
        return $product;
    }
    public function massDelete($productsIds){
        $commaSeparateIds = '(' . implode(', ', $productsIds) . ')';
        
        $deleteProductsQuery = 'DELETE FROM PRODUCT WHERE id IN ' . $commaSeparateIds .';';
        $this->executeQuery($deleteProductsQuery);
    }
    private function executeQuery($query, $params=[]){
        $result = $this->conn->execute_query($query,$params);
        return $result;
    }
}
