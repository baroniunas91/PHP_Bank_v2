<?php

namespace App\DB;

class Validator {
    public function validData(array $data, array $accounts) {
        // tikrinu ar name nėra skaičiaus, jei yra nepraleidžiu
        $enteredName = $data['name'];
        $validName = true;
        if(strlen($enteredName) <= 3) {
            $validName = false;
        }
        for($i=0; $i<strlen($enteredName); $i++) {
            if(is_numeric($enteredName[$i])) {
                $validName = false;
            }
        }
        
        // tikrinu ar surname nėra skaičiaus, jei yra nepraleidžiu
        $enteredSurname = $data['surname'];
        $validSurname = true;
        if(strlen($enteredSurname) <= 3) {
            $validSurname = false;
        }
        for($i=0; $i<strlen($enteredSurname); $i++) {
            if(is_numeric($enteredSurname[$i])) {
                $validSurname = false;
            }
        }

        // patikrinu asmens koda ar validus
        $personId = $data['personId'];
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


    public function validEdit(int $id, array $db) {
        $flag = true;
        foreach($db as $val) {
            if($val['id'] == $id) {
                $name = $val['name'];
                $surname = $val['surname'];
                $personId = $val['personId'];
                $bankAccount = $val['bankAccount'];
                $balance = $val['balance'];
                $flag = false;
            }
        }
        if($flag) {
            header('Location: '. URL . '404');
            die;
        }
        return ['name' => $name, 'surname' => $surname, 'personId' => $personId, 'bankAccount' => $bankAccount, 'balance' => $balance];
    }
}