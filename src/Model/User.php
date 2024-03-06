<?php

//namespace Model;

class User
{
    public function getUserByEmail(string $email): mixed
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $user = $db->prepare("SELECT * FROM users WHERE email = :email");
        $user->execute(['email' => $email]);
        return $user->fetch();
    }

    public function create( string $name, string $email, string $password): bool
    {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $psw_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute(['name' => $name, 'email' => $email,'password' => $psw_hash]);
    }
}