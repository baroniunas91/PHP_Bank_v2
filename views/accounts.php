<?php
    require DIR . '../views/top.php';
    require DIR . '../views/menu.php';
?>
<div class="content">
    <h1>Bank accounts list</h1>
    <div class="create">
        <a href="<?= URL . 'account/create' ?>" class="create-button">Create new account</a>
    </div>
    <!-- pridėda sąskaita sekmingai pranešimas -->
    <?php
    if(isset($_SESSION['addSuccess'])) : ?>
    <h3 class="addSuccess"><?= $_SESSION['addSuccess'] ?></h3>
    <?php 
    unset($_SESSION['addSuccess']);
    endif; ?>
    <!-- ištrinta sąskaita sėkmingai -->
    <?php
    if(isset($_SESSION['deleteSuccess'])) : ?>
    <h3 class="addSuccess">You successfully delete <?= $_SESSION['deleteName'] . ' ' . $_SESSION['deleteSurname']?> bank account</h3>
    <?php 
    unset($_SESSION['deleteSuccess']);
    unset($_SESSION['deleteName']);
    unset($_SESSION['deleteSurname']);
    endif; ?>
    <!-- ištrinti sąskaitos nepavyko pranešimas -->
    <?php
    if(isset($_SESSION['deleteNot'])) : ?>
    <h3 class="addWrong">You can delete accounts only with 0Eur account balance!</h3>
    <?php 
    unset($_SESSION['deleteNot']);
    endif; ?>
    <!-- pranešimas, kad paimti pinigus iš sąskaitos pavyko -->
    <?php
    if(isset($_SESSION['editSuccess'])) : ?>
    <h3 class="addSuccess">You are successfully edit <?= $_SESSION['editAccount']?> bank account!</h3>
    <?php 
    unset($_SESSION['editSuccess']);
    unset($_SESSION['editAccount']);
    endif; ?>
    <?php foreach($accountsDb as $value): ?>
    <div class=account>
        <div class="account-info">
            <p class="name"><?= $value['name'] ?></p>
            <p class="surname"><?= $value['surname'] ?></p>
            <p class="id"><?= $value['personId'] ?></p>
            <p class="bank-account"><?= $value['bankAccount'] ?></p>
            <p class="balance"><?= $value['balance']?>Eur</p>
        </div>
        <div class="account-actions">
            <form action="<?= URL . 'account/delete/' . $value['id'] ?>" method="post">
                <button class="button delete" name="delete" value="<?= $value['id'] ?>" type="submit">Delete</button>
            </form>
            <a class="button edit" href="<?= URL . 'account/edit/' . $value['id'] ?>">Edit</a>
            <a class="button add" href="<?= URL . 'account/add/' . $value['id'] ?>">Add</a>
            <a class="button take" href="<?= URL . 'account/take/' . $value['id'] ?>">Take</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php
    require DIR . '../views/bottom.php';
?>