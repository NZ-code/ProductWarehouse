<?php
require_once '../app/models/BookProduct.php';
require_once '../app/models/DvdProduct.php';
require_once '../app/models/FurnitureProduct.php';
class ProductFactory{
    public function __construct() {
        
    }
    public function createProduct($type, $name, $price, $sku){
        
        if($type == "book"){
            $product = new BookProduct($name, $price, $sku);
        }
        else if($type == "dvd"){
            $product = new DvdProduct($name, $price, $sku);
        }
        else if($type == "furniture"){
            $product = new FurnitureProduct($name, $price, $sku);
        }
        else{
            throw new Exception('Unknown product type.');
        }
        
        return $product;
    }
}