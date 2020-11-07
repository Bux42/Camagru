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
        include "database/mysql_connect.php";

        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE reset_url='$_GET[key]';");
        $stmt->execute();

        $query = $stmt->fetch();
        print_r($query);
        ?>
        <div class="red_div">
            <?php
            if ($query == null) {
                echo "Invalid reset url";
            }
            ?>
        </div>
        <div>
            <?php
            if ($query != null) {
                include "reset_password_form.php";
            }
            ?>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
</html>