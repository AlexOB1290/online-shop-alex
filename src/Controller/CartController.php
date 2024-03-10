<?php

class CartController
{
    private Product $productModel;
    private string $path;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->path = './../View/cart.php';
    }

    public function getCartPage(): void
    {
        $this->checkSession();

        if(empty($this->productModel->getAllByUserId($_SESSION['user_id']))){
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