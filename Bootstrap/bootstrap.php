<?php
session_start();
$path = preg_replace('/index\.php$/', '', $_SERVER['SCRIPT_NAME']);
$server = $_SERVER['SERVER_NAME'];
define('URL', 'http://'.$server.$path);