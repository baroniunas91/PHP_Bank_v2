<?php
use Bankas\AccoutController as Ac;

$route = '/' != $path ? str_replace($path, '', $_SERVER['REQUEST_URI']) : preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
$route = explode('/', $route);

$ac = new Ac();

if (('account' == $route[0] || '' == $route[0]) && 1 === count($route)) {
    $ac->index();

} else if('account' == $route[0] && 'create' == $route[1] && 2 === count($route)) {
    $ac->create();

} else if('account' == $route[0] && 'save' == $route[1] && 2 === count($route)) {
    $ac->save();

} else if('account' == $route[0] && 'edit' == $route[1] && 3 === count($route)) {
    $ac->edit($route[2]);

} else if('account' == $route[0] && 'update' == $route[1] && 3 === count($route)) {
    $ac->update($route[2]);

} else if('account' == $route[0] && 'delete' == $route[1] && 3 === count($route)) {
    $ac->delete($route[2]);

} else {
    require DIR.'../App/pages/404.php';
}