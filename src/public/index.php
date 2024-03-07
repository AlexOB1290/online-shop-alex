<?php
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$autoloadController = function (string $className) {
    $path = "./../Controller/$className.php";
    if (file_exists($path)) {
        require_once $path;

        return true;
    }

    return false;
};

spl_autoload_register($autoloadController);

//require_once './../Controller/UserController.php';
//require_once './../Controller/ProductController.php';
//require_once './../Controller/MainController.php';

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
//} elseif ($uri === '/add_product') {
//    $prod = new ProductController();
//    if ($method === 'GET') {
//        $prod->addProduct();
//    } elseif ($method === 'POST') {
//        $prod->addUserProduct();
//    } else {
//        echo "$method do not support for $uri";
//    }
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
} else {
    require_once '404.html';
}
