<?php
namespace App\DB;
use App\DB\Validator;
class JsonDb implements DataBase {

    private $data;
    private $validator;

    function create ( array $userData ) : void {
        $this->getData();
        $id = $this->getNextId();
        $data['id'] = $id;
        $data['name'] = $userData['name'];
        $data['surname'] = $userData['surname'];
        $data['personId'] = $userData['personId'];
        $data['bankAccount'] = $userData['bankAccount'];
        $data['balance'] = $userData['balance'];
        $this->insertData($data);
    }

    function update ( int $userId , array $userData ) : void {
        $db = $this->getData();
        foreach($db as $key => $user) {
            if($user['id'] == $userId) {
                $db[$key]['name'] = $userData['name'];
                $db[$key]['surname'] = $userData['surname'];
                $db[$key]['personId'] = $userData['personId'];
                $db[$key]['balance'] = round($userData['balance'], 2);
                $bankAccount = $db[$key]['bankAccount'];
            }
        }
        $_SESSION['editSuccess'] = true;
        $_SESSION['editAccount'] = $bankAccount;
        file_put_contents(DIR . '../App/data/accountsData.json', json_encode($db));
    }
    function delete ( int $userId ) : void {
        $db = $this->getData();
        foreach($db as $key => $user) {
            if($user['id'] == $userId) {
                $userName = $db[$key]['name'];
                $userSurname = $db[$key]['surname'];
                unset($db[$key]);
            }
        }
        $_SESSION['deleteSuccess'] = true;
        $_SESSION['deleteName'] = $userName;
        $_SESSION['deleteSurname'] = $userSurname;
        file_put_contents(DIR . '../App/data/accountsData.json', json_encode($db));
    }
    function show ( int $userId ) : array {
        $db = $this->getData();
        $this->validator = new Validator;
        return $this->validator->validEdit($userId, $db);
    }
    function showAll () : array {
        $accounts = $this->getData();
        usort($accounts, function($a, $b) {
            return $a['surname'] > $b['surname'];
        });
        return $accounts;
    }

    function getData() {
        return $this->data = json_decode(file_get_contents(DIR . '../App/data/accountsData.json'), 1);
    }

    function insertData(array $data) {
        $this->data[] = $data;
        $this->data = file_put_contents(DIR . '../App/data/accountsData.json', json_encode($this->data));
        $_SESSION['addSuccess'] = 'You are successfully added new account! Owner: ' . $data['name'] .' '. $data['surname'];
    }

    function getNextId() {
        if(count($this->data) == 0) {
            $id = 1;
        } else {
            $maxId = 0;
            foreach($this->data as $account) {
                if($account['id'] > $maxId) {
                    $maxId = $account['id'];
                }
            }
            $id = $maxId + 1;
        }
        return $id;
    }

    function generateBankAccount() {
        $bankAccount = 'LT';
        for($i=1; $i<=18; $i++) {
            if($i==3) {
                $bankAccount .= '7';
            } else if($i==4) {
                $bankAccount .= '3';
            } else if($i>=5 && $i <=7) {
                $bankAccount .= '0';
            } else {
                $bankAccount .= rand(0, 9);
            }
        }
        return $bankAccount;
    }

}