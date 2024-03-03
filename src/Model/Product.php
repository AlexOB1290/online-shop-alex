<?php

class Product
{
    public function setUserProdData(int $usID, array $post)
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $user_id = $usID;
        $product_id = $post['product_id'];
        $quantity = $post['quantity'];

        $stmt = $db->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        return $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id,'quantity' => $quantity]);
    }

    public function getProdById(array $post)
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $product_id = $post['product_id'];

        $stmt = $db->prepare("SELECT * FROM user_products WHERE product_id = :product_id");
        return $stmt->execute(['product_id'=>$product_id]);
    }
}