<?php

//namespace Controller;

class UserController
{

    private function validate(array $post): array
    {
        $errors = [];

        if(isset($post['name'])){
            $name = $post['name'];
        }else{
            $errors['name'] = "name must be fill";
        }

        if(isset($post['email'])){
            $email = $post['email'];
        }else{
            $errors['email'] = "email must be fill";
        }

        if(isset($post['psw'])){
            $password = $post['psw'];
        }else{
            $errors['psw'] = "psw must be fill";
        }

        if(isset($post['psw-repeat'])){
            $passwordRep = $post['psw-repeat'];
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
            require_once './../Model/User.php';
            $userModel = new User();
            if ($userModel->getOneByEmail($_POST)) {
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

    public function registrate(): void
    {
        require_once './../View/registrate.php';
    }

    public function postReg(): void
    {
        $err = $this->validate($_POST);
        if(empty($err)) {
            require_once './../Model/User.php';
            $userModel = new User();
            $userModel->setData($_POST);
        }
        require_once './../View/registrate.php';
    }

    public function login(): void
    {
        require_once './../View/login.php';
    }

    public function postLogin(): void
    {
        require_once './../Model/User.php';
        $userModel = new User();
        $res = $userModel->getOneByEmail($_POST);

        $password = $_POST['psw'];
        $email = $_POST['email'];

        if (empty($res)){
            $err = "User is not found";
        }elseif(password_verify($password, $res['password']) && $email === $res['email']){
            session_start();
            $_SESSION['user_id'] = $res['id'];

            header("Location: /main.php");
        }else{
            $err = "Password or email are wrong!";
        }
        require_once './../View/login.php';
    }
}

