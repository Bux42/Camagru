<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Camagru - Public Upload</title>
    <link href="/css/styles.css" rel="stylesheet">
</head>

<body>
    <?php
    include "top_menu.php";
    ?>
    <div class="main">
        <div class="red_div">
            <?php
            $image_id = -1;
            if (!isset($_GET["img_id"])) {
                echo "Invalid URL";
            } else {
                $image_id = intval($_GET["img_id"]);
                include "database/mysql_connect.php";
                $bdd = get_connection();
                $stmt = $bdd->prepare("SELECT * FROM user_images WHERE id=$image_id;");
                $stmt->execute();
                if (!($img_query = $stmt->fetch())) {
                    echo "Image not found";
                } else {
                    $stmt = $bdd->prepare("SELECT * FROM users WHERE id=$img_query[user_id];");
                    $stmt->execute();
                    $user_query = $stmt->fetch();
                }
            }
            ?>
        </div>
        <div>
            <?php
                if (isset($img_query)) {
                    $time = get_relative_time($img_query["dateadded"]);
                    echo "<img src='".$img_query["base64_img"]."'>";
                }
            ?>
        </div>
        <div>
            Uploaded <?php echo $time; ?> by <?php echo $user_query["username"] ?>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
</html>