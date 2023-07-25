<?php
require_once '../app/repositories/ProductRepository.php';
require_once '../app/models/Product.php';
require_once '../app/models/ProductFactory.php';
class AddProductController extends Controller
{   
    private $repository;
    public function __construct() {
        $this->repository = new ProductRepository();
    }
    public function index(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->postProduct();
        }
        
        $this->showView('addProductView', []);
    }
    private function postProduct(){
        $type = $this->getProductTypeFromRequest();
        $productFactory = new ProductFactory();
        $basicProductPropertiesNames = Product::getPropertiesNames();
        $basicProductProperties = $this->getProductPropertiesFromPostRequest($basicProductPropertiesNames);
        $productName = $basicProductProperties['name'];
        $productPrice = $basicProductProperties['price'];
        $productSku = $basicProductProperties['sku'];
        $product = $productFactory->createProduct($type, $productName, $productPrice, $productSku);
        $productPropertyNames = $product::getPropertiesNames();
        $productProperties = $this->getProductPropertiesFromPostRequest($productPropertyNames);
        
        $product->setSpecificProperties($productProperties);
    
        $this->repository->addProduct($product);
    }
    private function getProductTypeFromRequest(){
        if(isset($_POST['type'])){
            $type = $_POST['type'];
        }
        return $type;
    }


    private function getProductPropertiesFromPostRequest($productPropertyNames){
        $productProperties=[];
        foreach ($productPropertyNames as $productPropertyName) { 
            if(isset($_POST[$productPropertyName])){
                $productProperty = $_POST[$productPropertyName];
                $productProperties[$productPropertyName] = $productProperty;
            }
        }
        return $productProperties;
    }

}