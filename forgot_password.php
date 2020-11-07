<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Camagru - Login</title>
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php
    include "top_menu.php";
    ?>
    <div class="main">
        <form action="/mail_reset_password.php" method="post">
            <label>Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <br>
            <input type="submit" value="Reset Password">
        </form>
        <div class="red_div">
            <?php
            if (isset($_SESSION["mail_reset_password_error"])) {
                echo $_SESSION["mail_reset_password_error"];
                unset($_SESSION["mail_reset_password_error"]);
            }
            ?>
        </div>
        <div>
        <?php
        if (isset($_SESSION["mail_reset_password"])) {
            unset($_SESSION["mail_reset_password"]);
            echo "Reset link sent, check your emails";
        }
        ?>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
</html>