<?php

namespace Bankas;

class LoginView {
    public function showLoginForm() {
        return require DIR.'../App/views/login.php';
    }
}