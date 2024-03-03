<?php

class ProductController
{
    private function validate(int $userID, array $post): array
    {
        $errors = [];

        if(isset($post['product_id'])){
            $product_id = $post['product_id'];
        }else{
            $errors['product_id'] = "product_id must be fill";
        }

        if(isset($post['quantity'])){
            $quantity = $post['quantity'];
        }else{
            $errors['quantity'] = "quantity must be fill";
        }

        if(empty($errors['product_id'])){
            require_once './../Model/Product.php';
            $prodModel = new Product();
            if($prodModel->getProdById($_POST)){
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

        if(!isset($userID)){
            $errors['userId'] = "userID is not found";
        }
        return $errors;
    }

    public function addProd(): void
    {
        require_once './../View/add_product.php';
    }

    public function addUserProd(): void
    {
        session_start();
        $err = $this->validate($_SESSION['user_id'], $_POST);
        if(empty($err)) {
            require_once './../Model/Product.php';
            $userModel = new Product();
            $userModel->setUserProdData($_SESSION['user_id'], $_POST);
        }
        require_once './../View/add_product.php';
    }
}