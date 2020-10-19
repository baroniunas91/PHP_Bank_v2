<?php
namespace App\DB;

class JsonDb implements DataBase {

    private $data;

    function create ( array $userData ) : void {
        $this->getData();
        $id = $this->getNextId();
        $data['id'] = $id;
        $this->insertData($data);
    }

    function update ( int $userId , array $userData ) : void {

    }
    function delete ( int $userId ) : void {

    }
    function show ( int $userId ) : array {

    }
    function showAll () : array {
        echo 'save';
        return [];
    }

    function getData() {
        $this->data = json_decode(file_get_contents(DIR . '../App/data/accountsData.json'), 1);
    }

    function insertData(array $data) {
        $this->data[] = $data;
        $this->data = file_put_contents(DIR . '../App/data/accountsData.json', json_encode($data));
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

}