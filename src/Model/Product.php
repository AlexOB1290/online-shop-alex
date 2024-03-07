<?php

class Product
{

    public function addUserProduct(int $user_id, int $product_id, int $quantity): bool
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $stmt = $db->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        return $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id,'quantity' => $quantity]);
    }

    public function getProductById(int $product_id): bool
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $stmt = $db->prepare("SELECT * FROM user_products WHERE product_id = :product_id");
        return $stmt->execute(['product_id'=>$product_id]);
    }

    public function getAll(): false|array
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");
        $stmt = $db->query("SELECT * FROM products");
        $products = $stmt->fetchAll();
        return $products;
    }
}