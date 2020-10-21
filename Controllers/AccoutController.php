<?php

namespace Controllers;

use App\DB\Validator;
use App\DB\DbFactory;

class AccoutController  {

    private $makeDb = 'JsonDb';
    private $model;
    private $validator;

    public function create() {
        require DIR . '../views/create.php';
    }
    public function save() {
        $this->model = DbFactory::makeDatabase($this->makeDb);
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
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $accountData = $this->model->show($id);
        require DIR . '../views/edit.php';
    }
    public function update($id) {
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $postData = ['name' => $_POST['name'], 'surname' => $_POST['surname'], 'personId' => $_POST['personId'], 'balance' => $_POST['balance']];
        $this->validator = new Validator;
        $this->validator->validUpdate($id, $postData);
        $this->model->update($id, $postData);
        header('Location: ' . URL . 'account');
        die;
    }
    public function delete(int $id) {
        if(isset($_POST['delete'])) {
            $this->model = DbFactory::makeDatabase($this->makeDb);
            $this->validator = new Validator;
            $db = $this->model->getData();
            $this->validator->validDelete($id, $db);
            $this->model->delete($id);
            header('Location: ' . URL . 'account');
            die;
        } else {
            header('Location: ' . URL . '404');
            die;
        }
    }
    public function index() {
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $accountsDb = $this->model->showAll();
        require DIR . '../views/accounts.php';
    }

    public function add($id) {
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $add = $this->model->show($id);
        require DIR . '../views/add.php';
        // $add['balance'] = $add['balance'] + 55;
        // $this->model->update($id, $add);
    }
}