<?php

$val = $_POST;

function validateUser(array $val): array
{
    $errors = [];

    if(isset($val['name'])){
        $name = $val['name'];
    }else{
        $errors['name'] = "name must be fill";
    }

    if(isset($val['email'])){
        $email = $val['email'];
    }else{
        $errors['email'] = "email must be fill";
    }

    if(isset($val['psw'])){
        $password = $val['psw'];
    }else{
        $errors['psw'] = "psw must be fill";
    }

    if(isset($val['psw-repeat'])){
        $passwordRep = $val['psw-repeat'];
    }else{
        $errors['psw-repeat'] = "psw-repeat must be fill";
    }

    if(empty($name)){
        $errors['name'] = "name not be empty";
    }elseif(strlen($name)<2){
        $errors['name'] = "name must be more 1 symbols";
    }elseif(empty($email)){
        $errors['email'] = "email not be empty";
    }elseif(strlen($email)<2){
        $errors['email'] = "email must be more 1 symbols";
    }elseif(empty($password)){
        $errors['psw'] = "password not be empty";
    }elseif(strlen($password)<8){
        $errors['psw'] = "password must be more 8 symbols";
    }
return $errors;
}



//for($i=0; $i < strlen($email))

if(empty(validateUser($val))){
    $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email,'password' => $password]);
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email'=>$email]);

    $result = $stmt->fetch();

    print_r($result);
}

//require_once './registrate.php';