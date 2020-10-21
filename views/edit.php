<?php
    require DIR . '../views/top.php';
    require DIR . '../views/menu.php';
    $id = $accountData['id'];
    $name = $accountData['name'];
    $surname = $accountData['surname'];
    $personId = $accountData['personId'];
    $bankAccount = $accountData['bankAccount'];
    $balance = $accountData['balance'];
?>
<div class="content">
    <h1>Edit account</h1>
    <form class="newAccount" action="<?= URL . 'account/update/' . $id ?>" method="post">
        <div class="input">
            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter your name" value="<?= $name ?>">
            <?php
            if(isset($_SESSION['addWrongName'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongName'] ?></h3>
            <?php 
            unset($_SESSION['addWrongName']);
            endif; ?>
        </div>
        <div class="input">
            <label>Surname:</label>
            <input type="text" name="surname" placeholder="Enter your surname" value="<?= $surname ?>">
            <?php
            if(isset($_SESSION['addWrongSurname'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongSurname'] ?></h3>
            <?php 
            unset($_SESSION['addWrongSurname']);
            endif; ?>
        </div>
        <div class="input">
            <label>Person ID:</label>
            <input type="text" name="personId" placeholder="Enter your person ID" value="<?= $personId ?>">
            <?php
            if(isset($_SESSION['addWrongPersonId'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongPersonId'] ?></h3>
            <?php 
            unset($_SESSION['addWrongPersonId']);
            endif; ?>
        </div>
        <div class="input">
            <label>Bank Account:</label>
            <input type="text" name="bankAccount" value="<?= $bankAccount ?>" disabled>
        </div>
        <div class="input">
            <label>Balance:</label>
            <input type="text" name="balance" placeholder="Enter money" value="<?= $balance ?>">
            <?php
            if(isset($_SESSION['addWrongBalance'])) : ?>
            <p class="addWrong"><?= $_SESSION['addWrongBalance'] ?></h3>
            <?php 
            unset($_SESSION['addWrongBalance']);
            endif; ?>
        </div>
        <button type="submit" name="edit" value="1" class="create-account">Edit</button>
    </form>
    <div class="create">
        <a href="<?= URL . 'account' ?>" class="create-button">Back to accounts list</a>
    </div>
</div>
<?php
    require DIR . '../views/bottom.php';
?>