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
        <?php
        if (isset($_SESSION["user"])) {
            include "already_logged_in.php";
        } else {
            include "login_form.php";
        }
        ?>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
</html>