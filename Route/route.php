<?php
use Bankas\AccoutController as Ac;
use Bankas\LoginController as Lc;
use Bankas\NotFound as Nf;
use Bankas\TopAndBottomController as TBc;

$route = '/' != $path ? str_replace($path, '', $_SERVER['REQUEST_URI']) : preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
$route = explode('/', $route);

// Top HTML
$topAndBottom = new TBc;
$topAndBottom->showTop();

// Account
if (('account' == $route[0] || '' == $route[0]) && 1 === count($route)) {
    $ac = new Ac();
    $ac->index();

} else if('account' == $route[0] && 'create' == $route[1] && 2 === count($route)) {
    $ac = new Ac();
    $ac->create();

} else if('account' == $route[0] && 'save' == $route[1] && 2 === count($route)) {
    $ac = new Ac();
    $ac->save();

} else if('account' == $route[0] && 'edit' == $route[1] && 3 === count($route)) {
    $ac = new Ac();
    $ac->edit($route[2]);

} else if('account' == $route[0] && 'update' == $route[1] && 3 === count($route)) {
    $ac = new Ac();
    $ac->update($route[2]);

} else if('account' == $route[0] && 'delete' == $route[1] && 3 === count($route)) {
    $ac = new Ac();
    $ac->delete($route[2]);

// Login
} else if ('login' == $route[0]) {
    $lc = new Lc;
    $lc->showLogin();
}

// 404
else {  
    $nf = new Nf;
    $nf->showNotFound();
}

// Bottom HTML
return $topAndBottom->showBottom();