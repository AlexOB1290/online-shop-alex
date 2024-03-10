<?php

//namespace Controller;

class UserController
{
    private User $userModel;
    private string $pathRegistrate;
    private string $pathLogin;

    public function __construct()
    {
        $this->userModel = new User();
        $this->pathRegistrate = './../View/registrate.php';
        $this->pathLogin = './../View/login.php';
    }

    public function registrate(): void
    {
        require_once $this->pathRegistrate;
    }

    public function postRegistrate(): void
    {
        $error = $this->validateRegistrate($_POST);

        if(empty($error)) {
            $this->userModel->createUser($_POST['name'], $_POST['email'], $_POST['psw']);
        }
        require_once $this->pathRegistrate;
    }

    private function validateRegistrate(array $data): array
    {
        $errors = [];

        if(isset($data['name'])){
            $name = $data['name'];
        }else{
            $errors['name'] = "name must be fill";
        }

        if(isset($data['email'])){
            $email = $data['email'];
        }else{
            $errors['email'] = "email must be fill";
        }

        if(isset($data['psw'])){
            $password = $data['psw'];
        }else{
            $errors['psw'] = "psw must be fill";
        }

        if(isset($data['psw-repeat'])){
            $passwordRep = $data['psw-repeat'];
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
            if ($this->userModel->getOneByEmail($_POST['email'])) {
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

    public function login(): void
    {
        require_once $this->pathLogin;
    }

    public function postLogin(): void
    {
        $error = $this->validateLogin($_POST);

        if(empty($error)) {
            $user = $this->userModel->getOneByEmail($_POST['email']);
        }

        if (empty($user)){
            $err = "User is not found";
        }elseif(password_verify($_POST['psw'], $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['id'];

            header('Location: main');
        }else{
            $err = "Password or email are wrong!";
        }
        require_once $this->pathLogin;
    }
    private function validateLogin(array $data): array
    {
        $errors = [];

        if(isset($data['email'])){
            $email = $data['email'];
        }else{
            $errors['email'] = "email must be fill";
        }

        if(isset($data['psw'])){
            $password = $data['psw'];
        }else{
            $errors['psw'] = "psw must be fill";
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

        if(empty($password)){
            $errors['psw'] = "password not be empty";
        }elseif(strlen($password)<5) {
            $errors['psw'] = "password must be more 4 symbols";
        }

        return $errors;
    }

    public function logOut()
    {
        $_SESSION = [];
        session_destroy();

        header('Location: /login');
    }

}

