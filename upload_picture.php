<?php
session_start();

include "database/mysql_connect.php";

$_SESSION["upload_result"] = "Could not upload, invalid inputs";

if (isset($_POST["submit"]) && isset($_POST["overlay_id"]) && strlen($_POST["overlay_id"] > 0)) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $overlay_id = intval($_POST["overlay_id"]);
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM images WHERE id=$overlay_id;");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $bin = base64_decode(substr($_POST["image"], 22));
            $im = imagecreatefrompng($_FILES["fileToUpload"]);
            $overlay_image = imagecreatefrompng($query["url"]);
            imagecopy($im, $overlay_image, 0, 0, 0, 0, 500, 375);
            ob_start();
            imagepng($im);
            $contents = ob_get_contents();
            ob_end_clean();
            $final_img = "data:image/png;base64," . base64_encode($contents);
            $stmt = $bdd->prepare("INSERT INTO user_images (base64_img, user_id) VALUES ('$final_img', $_SESSION[user_id]);");
            $stmt->execute();
            unset($_SESSION["upload_result"]);
        }
    }
}
print_r($_POST);
exit();

if (isset($_POST["image"]) && isset($_POST["overlay_id"]) && strlen($_POST["overlay_id"] > 0))
{
    if (substr($_POST["image"], 0, 22) === "data:image/png;base64,")
    {
        $overlay_id = intval($_POST["overlay_id"]);
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM images WHERE id=$overlay_id;");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $bin = base64_decode(substr($_POST["image"], 22));
            $im = imageCreateFromString($bin);
            $overlay_image = imagecreatefrompng($query["url"]);
            imagecopy($im, $overlay_image, 0, 0, 0, 0, 500, 375);
            ob_start();
            imagepng($im);
            $contents = ob_get_contents();
            ob_end_clean();
            $final_img = "data:image/png;base64," . base64_encode($contents);
            $stmt = $bdd->prepare("INSERT INTO user_images (base64_img, user_id) VALUES ('$final_img', $_SESSION[user_id]);");
            $stmt->execute();
            unset($_SESSION["upload_result"]);
        }
    }
}
header('Location: /upload_panel.php');
?>