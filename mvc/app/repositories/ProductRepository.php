<?php
require_once '../app/databases/Database.php';
class ProductRepository{
    private $database;
    public function __construct() {
        $database = Database::getInstance();
        $this->database = $database;
    }
    public function addProduct($product){
        $this->database->addProduct($product);
    }
    public function getProducts(){
        return $this->database->getProducts();
    }
    public function deleteProducts($productsIds){
        $this->database->massDelete($productsIds);
    }

}