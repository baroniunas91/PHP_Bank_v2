<?php

namespace Bankas;

class NotFound {
    public function showNotFound() {
         return require DIR.'../App/views/404.php';
    }
}