<?php

namespace Bankas;

class LoginController  {
    private $view;

    public function doLogin() {
        $this->view = new LoginView;
        return $this->view->showLoginForm();
    }
}