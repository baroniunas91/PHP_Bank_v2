<?php

namespace Bankas;

class AccoutController  {
    private $model;
    private $view;

    public function create() {
        $this->model = new AccountModel;
        $this->view = new AccountView;
        
            $this->model->create([]);
            $this->view->showEmptyForm();
        
        echo 'create';
    }
    public function save() {
        if (isset($_POST['create'])) {
            $this->model->create($_POST['name'], $_POST['surname'], $_POST['personID']);
        }
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
        require DIR.'../App/pages/account.php';
    }
}