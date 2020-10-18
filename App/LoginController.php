<?php

namespace Bankas;

class LoginController  {
    private $view;

    public function showLogin() {
        $this->view = new LoginView;
        return $this->view->showLoginForm();
    }
    public function doLogin() {
        // Reikes modelio kur krepsis į DB
    }
}