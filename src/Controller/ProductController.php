<?php

class ProductController
{
    private Product $productModel;
    private string $path;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->path = './../View/main.php';
    }

    public function addUserProduct(): void
    {
        $this->checkSession();

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $array = $this->productModel->getOneByUserProductId($user_id, $product_id);

        $error = $this->validateProduct($_POST);
        if(empty($error)) {
            if(empty($array)){
                $this->productModel->addUserProduct($user_id, $product_id, $quantity);
            } else {
                $this->productModel->updateUserProduct($user_id, $product_id, $quantity);
            }
        }

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

    private function validateProduct(array $data): array
    {
        $errors = [];

        if(isset($data['product_id'])){
            $product_id = $data['product_id'];
        }else{
            $errors['product_id'] = "product_id must be fill";
        }

        if(isset($data['quantity'])){
            $quantity = $data['quantity'];
        }else{
            $errors['quantity'] = "quantity must be fill";
        }

        if(empty($errors['product_id'])){
            if($this->productModel->getOneByProductId($product_id)){
                $errors = [];
            } else {
                $errors['product_id'] = "This product does not exist";
            }
        }

        if(empty($quantity)){
            $errors['quantity'] = "quantity not be empty";
        }elseif($quantity<1){
            $errors['quantity'] = "quantity must be more 0";
        }elseif (!is_numeric($quantity)){
            $errors['quantity'] = "quantity must be integer";
        }

        return $errors;
    }
}