<?php

class App
{
    private $controllersMap;
    private $controller;
    
    public function __construct()
    {
        $this->setControllers();


        $this->handleRouting();
        
        $this->controller->index();


    }
    private function handleRouting(){
        $urlParams = $this->getPathVariables();
        if(isset($urlParams)){
            $firstPathParam = $urlParams[0];
            try{
                $this->controller = $this->getControllerByPathVar($firstPathParam);
            }
            catch(Exception $e){
                echo "No such page";
                //TODO No such page exeption
            }
        }
        else{
            $this->controller = $this->getDefaultController();
        }
    }
    private function getPathVariables(){
        if(isset($_GET['url'])){
             $trimedUrl = rtrim($_GET['url'], '/');
             $sanitizedUrl = filter_var($trimedUrl, FILTER_SANITIZE_URL);
             $urlParams = explode('/', $sanitizedUrl);
             return $urlParams;
         } 
     }
    private function setControllers(){
        $this->controllersMap = $this->getControllersMap();
    }
    private function getControllersMap(){
        require_once '../app/controllers/StoreController.php';
        require_once '../app/controllers/AddProductController.php';

        $controllersMap = array(
            "" => new StoreController(), 
            "addproduct" => new AddProductController()
        );
        return $controllersMap;
    }

    private function getControllerByPathVar($pathVar){
        if(isset($this->controllersMap[$pathVar])){
            return $this->controllersMap[$pathVar];
        }
        else{
            throw new Exception("No such page", 404);
        }

    }
    private function getDefaultController(){
        return $this->controllersMap[""];
    }
}