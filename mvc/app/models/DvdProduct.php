<?php

class DvdProduct extends Product{
    private $size;
    private static $propertiesNames = ['size'];
    public function __construct($name, $price, $sku) {
        parent::__construct($name, $price, $sku);
    }
    public static function getPropertiesNames()
    {
        return self::$propertiesNames;
    }
    public function getType(){
        return 'dvd';
    }
    public function getSpecificProperties(){
        $specificProperties = [];
        $specificProperties['size'] = $this->size;
        return $specificProperties;
    }

    public function setSpecificProperties($properties){
        $this->size = $properties['size'];
    }
}

