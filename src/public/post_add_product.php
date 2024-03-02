<?php
//session_start();
//print_r($_POST);
//print_r($_SESSION['user_id']);

require_once './add_product.php';

$db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$stmt = $db->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
$stmt->execute(['user_id' => $user_id, 'product_id' => $product_id,'quantity' => $quantity]);
$stmt = $db->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
$stmt->execute(['user_id'=>$user_id]);

$result = $stmt->fetch();

print_r ($result);

