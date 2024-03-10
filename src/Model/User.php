<?php

//namespace Model;

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");
    }

    public function getOneByEmail(string $email): mixed
    {
        $user = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $user->execute(['email' => $email]);
        return $user->fetch();
    }

    public function createUser(string $name, string $email, string $password): bool
    {
        $psw_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute(['name' => $name, 'email' => $email,'password' => $psw_hash]);
    }
}