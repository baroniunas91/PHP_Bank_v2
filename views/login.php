<?php
    require DIR . '../views/top.php';
?>
<div class="login">
    <h1>Welcome to my bank. Please login!</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name">
        <label for="psw">Password:</label>
        <input type="password" name="psw">
        <button type="submit">Login</button>
    </form>
    <!-- <p style="color: red; font-size: 18px"><?= $wrongLogin ?></p> -->
</div>
<?php
    require DIR . '../views/bottom.php';
?>