<?php

$val = $_POST;
# Validation
function validateLogin(array $val): array
{
    $errors = [];

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

    if(empty($email)){
        $errors['email'] = "email not be empty";
    }elseif(strlen($email)<2){
        $errors['email'] = "email must be more 1 symbols";
    }else{
        $res = "";
        for($i=0; $i < strlen($email); $i++) {
            if ($email[$i] === "@") {
                $res = $res.$email[$i];
            }
        }
        if(strlen($res)!==1){
            $errors['email'] = "email is wrong";
        }
    }

    if(empty($password)){
        $errors['psw'] = "password not be empty";
    }elseif(strlen($password)<5) {
        $errors['psw'] = "password must be more 4 symbols";
    }

    return $errors;
}

$errors = validateLogin($val);

if(empty($errors)){
    $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

    $email = $_POST['email'];
    $password = $_POST['psw'];
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email'=>$email]);
    $result = $stmt->fetch();

    $access = "";
    if(password_verify($password, $result['password'])) {
       $access = "Welcome to Site!";
    }else{
       $access = "Password is wrong!";
    }
    //print_r($result);
}

//print_r($errors);

require_once './login.php';