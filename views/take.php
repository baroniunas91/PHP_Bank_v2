<?php
    require DIR . '../views/top.php';
    require DIR . '../views/menu.php';
?>
<div class="content">
    <h1>Take money</h1>
    <h2 class="infoAboutAccount"><?= $take['name'] . ' ' . $take['surname']?></h2>
    <h2 class="infoAboutAccount">Account balance: <?= $take['balance']?>Eur</h2>
    <form class="moneyForm" action="<?= URL . 'account/update/' . $take['id']?>" method="post">
        <label>Take money:</label>
        <input type="text" name="toTake" placeholder="Enter money">
        <button type="submit" name="take2" value="<?= $take['id'] ?>">Take</button>
    </form>
    <?php if(isset($_SESSION['takeFalse'])) : ?>
            <p class="addWrong">Account balance can't be negative!</p>
        <?php 
        unset($_SESSION['takeFalse']);
        endif; ?>
        <?php if(isset($_SESSION['takeNotNumeric'])) : ?>
            <p class="addWrong">Please enter a number!</p>
        <?php 
        unset($_SESSION['takeNotNumeric']);
        endif; ?>
    <div class="create">
        <a href="<?= URL . 'account' ?>" class="create-button">Back to accounts list</a>
    </div>
</div>
<?php
    require DIR . '../views/bottom.php';