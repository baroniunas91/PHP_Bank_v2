<?php

namespace Controllers;

use App\DB\JsonDb as Db;
use App\DB\Validator;

class AccoutController  {

    private $model;
    private $validator;

    public function create() {
        require DIR . '../views/create.php';
    }
    public function save() {
        $this->model = new Db;
        $this->validator = new Validator;
        $postData = ['name' => $_POST['name'], 'surname' => $_POST['surname'], 'personId' => $_POST['personId']];
        $db = $this->model->getData();
        $this->validator->validData($postData, $db);
        $bankAccount = $this->model->generateBankAccount();
        $this->model->create(['name' => $postData['name'], 'surname' => $postData['surname'], 'personId' => $postData['personId'], 'bankAccount' => $bankAccount, 'balance' => 0]);
        header('Location: ' . URL . 'account');
        die;
    }
    public function edit(int $id) {
        $this->model = new Db;
        $db = $this->model->getData();
        $this->validator = new Validator;
        $accountData = $this->validator->validEdit($id, $db);
        require DIR . '../views/edit.php';
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