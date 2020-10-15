<?php

namespace Bankas;

class AccoutController  {
    public function create() {
        echo 'create';
    }
    public function save() {
        echo 'save';
    }
    public function edit(int $id) {
        echo 'edit ' . $id;
    }
    public function update() {
        echo 'update';
    }
    public function delete(int $id) {
        echo 'delete ' . $id;
    }
}