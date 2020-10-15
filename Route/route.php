<?php
use Bankas\AccoutController as Ac;

$route = '/' != $path ? str_replace($path, '', $_SERVER['REQUEST_URI']) : preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
$route = explode('/', $route);

if ('account' == $route[0] && 1 === count($route)) {
    require DIR.'../App/pages/account.php';
} else if('account' == $route[0] && 'create' == $route[1] && 2 === count($route)) {
    $create = new Ac();
    $create->create();
} else if('account' == $route[0] && 'save' == $route[1] && 2 === count($route)) {
    $create = new Ac();
    $create->save();
} else if('account' == $route[0] && 'edit' == $route[1] && 3 === count($route)) {
    $create = new Ac();
    $create->edit($route[2]);
} else if('account' == $route[0] && 'update' == $route[1] && 2 === count($route)) {
    $create = new Ac();
    $create->update();
} else if('account' == $route[0] && 'delete' == $route[1] && 3 === count($route)) {
    $create = new Ac();
    $create->delete($route[2]);
} else {
    require DIR.'../App/pages/404.php';
}