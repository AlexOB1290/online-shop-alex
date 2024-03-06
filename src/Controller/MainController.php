<?php
require_once './../Model/Product.php';
class MainController
{
    public function getMainPage()
    {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
        }

        $productModel = new Product();
        if(empty($productModel->getAll())){
            echo 'Products does not exist';
        } else {
            require_once './../View/main.php';
        }
    }
}