<?php
include "get_account_infos.php";
?>

<?php
//print_r($user_infos);
?>



<div>
    <div>
        <div>
            <?php
            if (isset($_SESSION["send_verification_mail"])) {
                echo $_SESSION["send_verification_mail"];
                unset($_SESSION["send_verification_mail"]);
            } else if ($user_infos["verified"] === "0") {
                echo "Your account is not verified <a href='/send_verification_email.php'>Resent Email</a>";
            }
            ?>
        </div>
        <div>
            <label>Username: <?php echo $user_infos["username"]; ?></label>
        </div>
        <div>
            <label>Email: <?php echo $user_infos["email"]; ?></label>
        </div>
    </div>
    <!--
    <label>Username: <?php echo $user_infos["username"]; ?></label><br>
    <form action="/login_account.php" method="post">
        <label>New Username:</label><br>
        <input type="text" id="username" name="username" value="hello" required><br>
        <label>Password:</label><br>
        <input type="password" id="password" name="password" value="hello" required><br>
        <br>
        <input type="submit" value="Submit">
    </form>
    -->
</div>