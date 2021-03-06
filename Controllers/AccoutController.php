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
        if(isset($_POST['take']) || isset($_POST['balance'])) {
            $this->model = DbFactory::makeDatabase($this->makeDb);
            $postData = $_POST;
            if(isset($postData['take'])) {
                $newBalance = $this->takeMoney($id, $postData['take']);
                $this->model = DbFactory::makeDatabase($this->makeDb);
                $take = $this->model->show($id);
                $_SESSION['takeSuccess'] = true;
                $_SESSION['takeSuccessAccount'] = $take['bankAccount'];
                $_SESSION['takeSuccessQty'] = $postData['take'];
                header('Location: ' . URL . 'account');
                die;
            } else if(!isset($postData['name'])) {
                $newBalance = $this->addMoney($id, $postData['balance']);
                $this->model = DbFactory::makeDatabase($this->makeDb);
                $add = $this->model->show($id);
                $_SESSION['addMoneySuccess'] = true;
                $_SESSION['addMoneySuccessAccount'] = $add['bankAccount'];
                $_SESSION['addMoneySuccessQty'] = $postData['balance'];
                header('Location: ' . URL . 'account');
                die;
            } else {
                $this->validator = new Validator;
                $this->validator->validUpdate($id, $postData);
                $this->model->update($id, $postData);
                $this->model = DbFactory::makeDatabase($this->makeDb);
                $edit = $this->model->show($id);
                $_SESSION['editSuccess'] = true;
                $_SESSION['editAccount'] = $edit['bankAccount'];
                header('Location: ' . URL . 'account');
                die;
            }
        } else {
            header('Location: ' . URL . '404');
            die;
        }
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

    public function take($id) {
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $take = $this->model->show($id);
        require DIR . '../views/take.php';
    }

    public function addMoney($id, $addMoney) {
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $add = $this->model->show($id);
        $this->validator = new Validator;
        $this->validator->validUpdate($id, ['balance' => $addMoney]);
        $karma = $this->changeInput($addMoney);
        if(isset($karma)) {
            $addMoney = $this->changeInput($addMoney);
        }
        $add['balance'] = $add['balance'] + $addMoney;
        $this->model->update($id, $add);
    }

    public function takeMoney($id, $takeMoney) {
        $this->model = DbFactory::makeDatabase($this->makeDb);
        $take = $this->model->show($id);
        $this->validator = new Validator;
        $this->validator->validTake($takeMoney, $take);
        $karma = $this->changeInput($takeMoney);
        if(isset($karma)) {
            $takeMoney = $this->changeInput($takeMoney);
        }
        $take['balance'] = $take['balance'] - $takeMoney;
        $this->model->update($id, $take);
    }

    public function changeInput($enteredBalance) {
        if(!is_numeric($enteredBalance)) {
            $searchForValue = ',';
            $stringValue = $enteredBalance;
            if(strpos($stringValue, $searchForValue) !== false ) {
                $enteredBalance = str_replace(',', '.', $enteredBalance);
                return $enteredBalance;
            }
        }
    }
}