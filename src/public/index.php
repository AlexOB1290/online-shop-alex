<?php
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if($uri === '/registrate'){
    require_once './../Controller/UserController.php';
    $reg = new UserController();
    if($method === 'GET'){
        $reg->registrate();
    }elseif ($method === 'POST'){
        $reg->postReg();
    } else {
        echo "$method do not support for $uri";
    }
} elseif ($uri === '/login'){
    require_once './../Controller/UserController.php';
    $log = new UserController();
    if($method === 'GET'){
        $log->login();
    }elseif ($method === 'POST'){
        $log->postLogin();
    } else {
        echo "$method do not support for $uri";
    }
} elseif ($uri === '/add_product') {
    require_once './../Controller/ProductController.php';
    $prod = new ProductController();
    if ($method === 'GET') {
        $prod->addProd();
    } elseif ($method === 'POST') {
        $prod->addUserProd();;
    } else {
        echo "$method do not support for $uri";
    }
} elseif ($uri === '/main'){
    if($method === 'GET'){
        require_once 'main.php';
    } else {
        echo "$method do not support for $uri";
    }
} else {
    require_once '404.html';
}
