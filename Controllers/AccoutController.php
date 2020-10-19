<?php

namespace Controllers;

use App\DB\JsonDb as Db;

class AccoutController  {

    private $model;

    public function create() {
        require DIR . '../views/create.php';
    }
    public function save() {
        $this->model = new Db;
        $this->model->create(['name' => $_POST['name'], 'surname' => $_POST['surname'], 'personId' => $_POST['personId']]);
        header('Location: ' . URL . 'account');
        die;
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
        $this->model = new Db;
        $accountsDb = $this->model->showAll();
        require DIR . '../views/accounts.php';
    }
}