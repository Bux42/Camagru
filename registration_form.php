<form action="/create_account.php" method="post">
    <label>Username:</label><br>
    <input type="text" id="username" name="username" value="hello" required><br>
    <label>Email:</label><br>
    <input type="email" id="email" name="email" value="virgile.desvaux@gmail.com" required><br>
    <label>Password:</label><br>
    <input type="password" id="password" name="password" value="hello" required><br>
    <br>
    <input type="submit" value="Register">
</form>
<div class="registration_error">
    <?php 
    if (isset($_SESSION["registration_error"])){
        foreach ($_SESSION["registration_error"] as $error) {
            echo "$error<br>";
        }
        $_SESSION["registration_error"] = array();
    }
    ?>
</div>