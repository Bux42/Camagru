<?php
include "get_account_infos.php";
?>

<?php
print_r($user_infos);
?>

<div>
    <label>Username: <?php echo $user_infos["username"]; ?></label><br>
    <form action="/login_account.php" method="post">
        <label>New Username:</label><br>
        <input type="text" id="username" name="username" value="hello" required><br>
        <label>Password:</label><br>
        <input type="password" id="password" name="password" value="hello" required><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>