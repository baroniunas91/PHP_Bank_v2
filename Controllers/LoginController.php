<?php

namespace Controllers;

class LoginController  {
    private $view;

    public function showLogin() {
        require DIR . '../views/login.php';
    }
    public function doLogin() {
        // Reikes modelio kur krepsis į DB
    }
}