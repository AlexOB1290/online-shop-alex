<?php

require_once './../Core/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->registate();

$app = new App();
$app->run();