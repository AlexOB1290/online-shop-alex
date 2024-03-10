<?php

class Product
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");
    }

    public function addUserProduct(int $user_id, int $product_id, int $quantity): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        return $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id,'quantity' => $quantity]);
    }

    public function updateUserProduct(int $user_id, int $product_id, int $quantity): bool
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id");
        return $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id,'quantity' => $quantity]);
    }

    public function getOneByProductId(int $product_id): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE product_id = :product_id");
        return $stmt->execute(['product_id'=>$product_id]);
    }

    public function getAllByUserId(int $user_id): false|array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $products = $stmt->fetchAll();
        return $products;
    }

    public function getOneByUserProductId(int $user_id, int $product_id): false|array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $products = $stmt->fetch();
        return $products;
    }

    public function getAll(): false|array
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();
        return $products;
    }
}