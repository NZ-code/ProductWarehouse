<?php

class BookProduct extends Product{
    private $weight;
    private static $propertiesNames = ['weight'];
    public function __construct($name, $price, $sku) {
        parent::__construct($name, $price, $sku);
    }
    public static function getPropertiesNames()
    {
        return self::$propertiesNames;
    }
    public function getType(){
        return 'book';
    }

    public function getSpecificProperties(){
        $specificProperties = [];
        $specificProperties['weight'] = $this->weight;
        return $specificProperties;
    }
    public function setSpecificProperties($properties){
        $this->weight = $properties['weight'];
    }
    public function jsonSerialize(){
        $baseDictionary = parent::getBasicJsonDictionary();
        $specificDictionary = $this->getSpecificProperties();
        return array_merge($baseDictionary, ["properties"=> $specificDictionary]);
    }
}

