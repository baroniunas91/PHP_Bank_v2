<?php
    require DIR . '../views/top.php';
    require DIR . '../views/menu.php';
?>
<div class="content">
    <h1>Create new account</h1>
    <form class="newAccount" action="<?= URL . 'account/save' ?>" method="post">
        <div class="input">
            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter your name">
            <?php
            if(isset($_SESSION['addWrongName'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongName'] ?></h3>
            <?php 
            unset($_SESSION['addWrongName']);
            endif; ?>
        </div>
        <div class="input">
            <label>Surname:</label>
            <input type="text" name="surname" placeholder="Enter your surname">
            <?php
            if(isset($_SESSION['addWrongSurname'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongSurname'] ?></h3>
            <?php 
            unset($_SESSION['addWrongSurname']);
            endif; ?>
        </div>
        <div class="input">
            <label>Person ID:</label>
            <input type="text" name="personId" placeholder="Enter your person ID">
            <?php
            if(isset($_SESSION['addWrongPersonId'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongPersonId'] ?></h3>
            <?php 
            unset($_SESSION['addWrongPersonId']);
            endif; ?>
        </div>
        <button type="submit" name="create" value="1" class="create-account">Create</button>
    </form>
    <div class="create">
        <a href="<?= URL . 'account' ?>" class="create-button">Back to accounts list</a>
    </div>
</div>
<?php
    require DIR . '../views/bottom.php';
?>