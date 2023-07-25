<?php

class FurnitureProduct extends Product{
    private $height;
    private $width;
    private $length;
    private static $propertiesNames = ['height','width','length'];
    public function __construct($name, $price, $sku) {
        parent::__construct($name, $price, $sku);
    }
    public static function getPropertiesNames()
    {
        return self::$propertiesNames;
    }
    public function getType(){
        return 'furniture';
    }
    public function getSpecificProperties(){
        $specificProperties = [];
        $specificProperties['height'] = $this->height;
        $specificProperties['width'] = $this->width;
        $specificProperties['length'] = $this->length;
        return $specificProperties;
    }

    public function setSpecificProperties($properties){
        
        $this->height = $properties['height'];
        $this->width = $properties['width'];
        $this->length = $properties['length'];
    }
}

