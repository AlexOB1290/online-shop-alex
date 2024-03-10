<?php
require_once './../Model/Product.php';
class MainController
{
    private Product $productModel;
    private string $path;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->path = './../View/main.php';
    }

    public function getMainPage(): void
    {
        $this->checkSession();

        if(empty($this->productModel->getAll())){
            echo 'Products does not exist';
        } else {
            require_once $this->path;
        }
    }

    private function checkSession(): void
    {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
        }
    }
}