<?php

//namespace Model;

class User
{
    public function getOneByEmail(array $val): mixed
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $email = $val['email'];

        $user = $db->prepare("SELECT * FROM users WHERE email = :email");
        $user->execute(['email' => $email]);
        return $user->fetch();
    }
    public function setData(array $post): bool
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $name = $post['name'];
        $email = $post['email'];
        $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute(['name' => $name, 'email' => $email,'password' => $password]);
    }
}