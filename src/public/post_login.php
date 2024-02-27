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
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");
        $email = strtolower($val['email']);
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email'=>$email]);
        $user = $stmt->fetch();
        if($user === false){
            $errors['email'] = "User not found";
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

    $email = strtolower ($_POST['email']);
    $password = $_POST['psw'];
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email'=>$email]);
    $user = $stmt->fetch();

    $access = "";
    if (empty($user['password'])){
        echo "Error! password is failure";
    } elseif (password_verify($password, $user['password'])) {
        //print_r($user);
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: /main.php");
    }else{
       $access = "Password or email are wrong!";
    }
    //print_r($result);
}

//print_r($errors);

require_once './login.php';