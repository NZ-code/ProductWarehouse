<?php 

class Controller{
    
    public function showView($view, $data)
    {   
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }
}