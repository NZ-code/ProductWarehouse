<?php

abstract class Product implements JsonSerializable{
    public function __construct($name, $price, $sku) {
        $this->name= $name;
        $this->price = $price;
        $this->sku = $sku;
    }
    private $id;
    private $name;
    private $price;
    private $sku;
    private static $propertiesNames = ['name', 'price', 'sku', 'type'];
    abstract public function getType();
    abstract public function getSpecificProperties();
    abstract public function setSpecificProperties($properties);
    abstract public function jsonSerialize();
    public static function getPropertiesNames()
    {
        return self::$propertiesNames;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getSku(){
        return $this->sku;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getBasicJsonDictionary(){
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'sku' => $this->getSku(),
            'price' => $this->getPrice()
        ];
    }



}
