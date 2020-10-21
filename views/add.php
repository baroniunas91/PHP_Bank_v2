<?php
    require DIR . '../views/top.php';
    require DIR . '../views/menu.php';
?>
<div class="content">
    <h1>Add money</h1>
    <h2 class="infoAboutAccount"><?= $add['name'] . ' ' . $add['surname']?></h2>
    <h2 class="infoAboutAccount">Account balance: <?= $add['balance']?>Eur</h2>
    <form class="moneyForm" action="<?= URL . 'account/update/' . $add['id']?>" method="post">
        <label>Add money:</label>
        <input type="text" name="qty" placeholder="Enter money">
        <button type="submit" name="index" value="<?= $add['id'] ?>">Add</button>
    </form>
    <?php if(isset($_SESSION['addNotNumeric'])) : ?>
        <p class="addWrong">Please enter a number!</p>
    <?php 
    unset($_SESSION['addNotNumeric']);
    endif; ?>
    <div class="create">
        <a href="<?= URL . 'account' ?>" class="create-button">Back to accounts list</a>
    </div>
</div>
<?php
    require DIR . '../views/bottom.php';
?>