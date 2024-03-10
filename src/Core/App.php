<?php

class App
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if($uri === '/registrate'){
            $reg = new UserController();
            if($method === 'GET'){
                $reg->registrate();
            }elseif ($method === 'POST'){
                $reg->postRegistrate();
            } else {
                echo "$method do not support for $uri";
            }
        } elseif ($uri === '/login'){
            $log = new UserController();
            if($method === 'GET'){
                $log->login();
            }elseif ($method === 'POST'){
                $log->postLogin();
            } else {
                echo "$method do not support for $uri";
            }
        } elseif ($uri === '/main'){
            $main = new MainController();
            $prod = new ProductController();
            if($method === 'GET'){
                $main->getMainPage();
            } elseif ($method === 'POST') {
                $prod->addUserProduct();
            } else {
                echo "$method do not support for $uri";
            }
        } elseif ($uri === '/cart'){
            $cart = new CartController();
            if($method === 'GET'){
                $cart->getCartPage();
            } else {
                echo "$method do not support for $uri";
            }
        } else {
            require_once '404.html';
        }
    }
}