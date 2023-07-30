<?php
require_once '../app/repositories/ProductRepository.php';
require_once '../app/models/Product.php';
require_once '../app/models/ProductFactory.php';
require_once '../app/utils/Constants.php';
class StoreController extends Controller
{
    private $repository;
    public function __construct() {
        $this->repository = new ProductRepository();
    }
    public function index(){

        $this->handleCors();

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $products = $this->repository->getProducts();   
            $data = array(
                'products' => $products,
            );
            $this->showView('storeView/storeView', $data);
        }
        else if($_SERVER['REQUEST_METHOD'] === 'PATCH'){
            $this->massDeleteProducts();   
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->postProduct();
        }
        
    }
    private function handleCors() {
        $allowedOrigins = CLIENT_ORIGIN;
        $allowedMethods = 'GET, POST, OPTIONS, PATCH';
        $allowedHeaders = 'Content-Type, Authorization';
        $maxAge = 3600;

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("Access-Control-Allow-Origin: $allowedOrigins");
            header("Access-Control-Allow-Methods: $allowedMethods");
            header("Access-Control-Allow-Headers: $allowedHeaders");
            header("Access-Control-Max-Age: $maxAge");
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            exit();
        }
        header("Access-Control-Allow-Origin: $allowedOrigins");
    }
    private function massDeleteProducts(){
        $data = file_get_contents('php://input');
        $decodedData = json_decode($data, true);
        if (isset($decodedData['data']['productsIds']) && is_array($decodedData['data']['productsIds'])) {
            $productsIds = $decodedData['data']['productsIds'];
            $this->repository->deleteProducts($productsIds);
        }
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
