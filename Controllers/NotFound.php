<?php

namespace Controllers;

class NotFound {
    public function showNotFound() {
         return require DIR.'../views/404.php';
    }
}