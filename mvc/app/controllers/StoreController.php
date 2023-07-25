<?php
class StoreController extends Controller
{
    private $repository;
    public function __construct() {
        $this->repository = new ProductRepository();
    }
    public function index(){
        if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $this->deleteProducts();
            
        }

        $products = $this->repository->getProducts();   
        $data = array(
            'products' => $products,
        );
        $this->showView('storeView/storeView', $data);
        
    }
    private function deleteProducts(){
        $data = json_decode(file_get_contents("php://input"), true);
        $this->repository->deleteProducts($data['productsIds']);
    }
    
}