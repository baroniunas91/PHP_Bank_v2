<?php

namespace Bankas;

class AccoutController  {
    private $model;
    private $view;

    public function create() {
        $this->view = new AccountView;
        $this->view->showCreateView();
    }
    public function save() {
        echo 'save';
    }
    public function edit(int $id) {
        echo 'edit ' . $id;
    }
    public function update($id) {
        echo 'update '  . $id;
    }
    public function delete(int $id) {
        echo 'delete ' . $id;
    }
    public function index() {
        $this->view = new AccountView;
        $this->view->showIndexView();
    }
}