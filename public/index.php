<?php

define('DIR', __DIR__ . '/');
require DIR . '../Bootstrap/bootstrap.php';
require DIR . '../vendor/autoload.php';
require DIR . '../Route/route.php';

// use Bankas\Klase;

// $route = '/' != $path ? str_replace($path, '', $_SERVER['REQUEST_URI']) : preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
// $route = explode('/', $route);

// echo '<pre>';
// print_r($route);
// echo '</pre>';

// if ('add' == $route[0] && 1 === count($route)) {
//     require DIR.'../App/pages/add.php';
// } else {
//     require DIR.'../App/pages/404.php';
// }

// $k = new Klase;
// $k->balsas();
