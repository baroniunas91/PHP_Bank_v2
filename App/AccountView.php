<?php

namespace Bankas;

class AccountView {
    public function showCreateView() {
        return require DIR.'../App/views/create.php';
    }
    public function showIndexView() {
        return require DIR.'../App/views/accounts.php';
    } 
}