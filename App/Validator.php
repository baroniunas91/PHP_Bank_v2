<?php

namespace App\DB;

class Validator {
    public function validName($enteredName) {
        // tikrinu ar name nėra skaičiaus, jei yra nepraleidžiu
        $validName = true;
        if(strlen($enteredName) <= 3) {
            $validName = false;
        }
        for($i=0; $i<strlen($enteredName); $i++) {
            if(is_numeric($enteredName[$i])) {
                $validName = false;
            }
        }
        return $validName;
    }

    public function validSurname($enteredSurname) {
        // tikrinu ar surname nėra skaičiaus, jei yra nepraleidžiu
        $validSurname = true;
        if(strlen($enteredSurname) <= 3) {
            $validSurname = false;
        }
        for($i=0; $i<strlen($enteredSurname); $i++) {
            if(is_numeric($enteredSurname[$i])) {
                $validSurname = false;
            }
        }
        return $validSurname;
    }

    public function validPersonId($personId) {
        // patikrinu asmens koda ar validus
        $personIdValid = true;
        if(strlen($personId) != 11 || !is_numeric($personId)) {
            $personIdValid = false;
        }
        //patikrinu ar pirmas skaicius geras nuo 1 iki 6
        $firstNr = false;
        if(strlen($personId) == 11) {
            for($i=1; $i<=6; $i++) {
                if((int)$personId[0] == $i) {
                    $firstNr = true;
                }
            }
        }
        if(!$firstNr) {
            $personIdValid = false;
        }

        foreach($accounts as $value) {
            if($personId == $value['personId']) {
                $personIdValid = false;
            }
        }
        return $personIdValid;
    }

    public function validData(array $data, array $accounts) {
        $validName = $this->validName($data['name']);
        $validSurname = $this->validSurname($data['surname']);
        $personIdValid = $this->validPersonId($data['personId']);

        // jei kazkur buvo nevalidu redirectins vel vesti is naujo
        if(!$validName || !$validSurname || !$personIdValid) {
            if(!$validName) {
                $_SESSION['addWrongName'] = 'Name should be more than 3 symbols and symbols should be not a numbers!';
            }
            if(!$validSurname) {
                $_SESSION['addWrongSurname'] = 'Surname should be more than 3 symbols and symbols should be not a numbers!';
            }
            if(!$personIdValid) {
                $_SESSION['addWrongPersonId'] = 'Person ID is not valid!';
            }
            header('Location: '. URL . 'account/create');
            die;
        }
    }

    public function validUpdate($id, array $enteredData) {
        if(isset($enteredData['name'])) {
            $validName = $this->validName($enteredData['name']);
        } else {
            $validName = true;
        }
        if(isset($enteredData['surname'])) {
            $validSurname = $this->validSurname($enteredData['surname']);
        } else {
            $validSurname = true;
        }
        if(isset($enteredData['personId'])) {
            $personIdValid = $this->validPersonId($enteredData['personId']);
        } else {
            $personIdValid = true;
        }
        if(isset($enteredData['balance'])) {
            $validBalance = $this->validBalance($enteredData['balance']);
        } else {
            $validBalance = true;
        }

        // jei kazkur buvo nevalidu redirectins vel vesti is naujo
        if(!$validName || !$validSurname || !$personIdValid || !$validBalance) {
            if(!$validName) {
                $_SESSION['addWrongName'] = 'Name should be more than 3 symbols and symbols should be not a numbers!';
            }
            if(!$validSurname) {
                $_SESSION['addWrongSurname'] = 'Surname should be more than 3 symbols and symbols should be not a numbers!';
            }
            if(!$personIdValid) {
                $_SESSION['addWrongPersonId'] = 'Person ID is not valid!';
            }
            if(!$validBalance) {
                $_SESSION['addWrongBalance'] = 'Balance should be number and not less than 0Eur!';
            }
            if(isset($enteredData['name'])) {
                header('Location: '. URL . 'account/edit/' . $id);
                die;
            } else {
                header('Location: '. URL . 'account/add/' . $id);
                die;
            }
        }
    }

    public function validBalance($enteredBalance) {
        // jei vietoj '.' įvedė ',' pakeičiu.
        if(!is_numeric($enteredBalance)) {
            $searchForValue = ',';
            $stringValue = $enteredBalance;
            if(strpos($stringValue, $searchForValue) !== false ) {
                $enteredBalance = str_replace(',', '.', $enteredBalance);
            }
        }
        if(!is_numeric($enteredBalance)) {
            return false;
        }
        if(is_numeric($enteredBalance) && $enteredBalance < 0) {
            return false;
        }
        return true;
    }

    public function validDelete(string $userId, array $db) {
        foreach($db as $key => $user) {
            if($user['id'] == $userId) {
                if($db[$key]['balance'] != 0) {
                    $_SESSION['deleteNot'] = true;
                    break;
                }
            }
        }
        if(isset($_SESSION['deleteNot'])) {
            header('Location: '. URL . 'account');
            die;
        }
    }

    public function validTake($takeMoney, $userData) {
        $validNumber = $this->validBalance($takeMoney);
        if(!$validNumber) {
            $_SESSION['takeNotNumeric'] = true;
            header('Location: '. URL . 'account/take/' . $userData['id']);
            die;
        }
        if($userData['balance'] - $takeMoney < 0) {
            $_SESSION['takeFalse'] = true;
            header('Location: '. URL . 'account/take/' . $userData['id']);
            die;
        }
        return true;
    }
}