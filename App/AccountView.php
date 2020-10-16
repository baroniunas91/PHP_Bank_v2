<?php

namespace Bankas;

class AccountView {
    public function showEmptyForm() {
        ?>
        <form action="" method="post">
            <label for="">Name</label>
            <input type="text">
            <label for="">Surname</label>
            <input type="text">
            <label for="">Person ID</label>
            <input type="text">
            <button type="submit">Create</button>
        </form>
        <?php
    }
}