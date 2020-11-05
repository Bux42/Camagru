<form action="/login_account.php" method="post">
    <label>Username:</label><br>
    <input type="text" id="username" name="username" value="hello" required><br>
    <label>Password:</label><br>
    <input type="password" id="password" name="password" value="hello" required><br>
    <br>
    <input type="submit" value="Login">
</form>
<div class="login_error">
    <?php 
            if (isset($_SESSION["login_error"])){
                foreach ($_SESSION["login_error"] as $error) {
                    echo "$error<br>";
                }
                $_SESSION["login_error"] = array();
            }
        ?>
</div>