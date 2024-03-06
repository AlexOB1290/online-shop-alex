<?php

class ProductController
{
    private function validate(int $userID, int $product_id, int $quantity): array
    {
        $errors = [];

        if(!isset($userID)){
            $errors['userId'] = "userID is not found";
        }

        if(!isset($product_id)){
            $errors['product_id'] = "product_id must be fill";
        }

        if(!isset($quantity)){
            $errors['quantity'] = "quantity must be fill";
        }

        if(empty($errors['product_id'])){
            require_once './../Model/Product.php';
            $productModel = new Product();
            if($productModel->getProductById($product_id)){
                $errors = [];
            } else {
                $errors['product_id'] = "This product does not exist";
            }
        }

        if(empty($quantity)){
            $errors['quantity'] = "quantity not be empty";
        }elseif(strlen($quantity)<1){
            $errors['quantity'] = "quantity must be more 0";
        }

        return $errors;
    }

    public function addProduct(): void
    {
        require_once './../View/add_product.php';
    }

    public function addUserProduct(): void
    {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
        }

        $error = $this->validate($_SESSION['user_id'], $_POST['product_id'], $_POST['quantity']);
        if(empty($error)) {
            require_once './../Model/Product.php';
            $userModel = new Product();
            $userModel->addUserProduct($_SESSION['user_id'], $_POST['product_id'], $_POST['quantity']);
        }

        $productModel = new Product();
        if(empty($productModel->getAll())){
            echo 'Products does not exist';
        } else {
            require_once './../View/main.php';
        }
    }
}