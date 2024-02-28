<?php
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
    }

    if(empty($email)){
        $errors['email'] = "email not be empty";
    }elseif(strlen($email)<2){
        $errors['email'] = "email must be more 1 symbols";
    }elseif(strlen($email)>2){
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
    if(empty($errors['email'])) {
        $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

        $email = $val['email'];

        $user = $db->prepare("SELECT * FROM users WHERE email = :email");
        $user->execute(['email' => $email]);
        $user = $user->fetch();
        if ($user) {
            $errors['email'] = "this email exist";
        }
    }

    if(empty($password)){
        $errors['psw'] = "password not be empty";
    }elseif(strlen($password)<5){
        $errors['psw'] = "password must be more 4 symbols";
    }elseif ($password !== $passwordRep){
        $errors['psw-repeat'] = "password does not match";
    }
return $errors;
}
$errors = validateUser($_POST);
//print_r($errors);
#add to DB



if(empty($errors)){
    $db = new PDO("pgsql:host=postgres; port=5432; dbname=dbtest", "dbroot", "dbroot");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email,'password' => $password]);
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email'=>$email]);

    $result = $stmt->fetch();
}

require_once './registrate.php';