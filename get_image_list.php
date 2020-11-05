<?php
include "database/mysql_connect.php";

$bdd = get_connection();
$image_list_query = $bdd->prepare("SELECT * FROM images;");
$image_list_query->execute();

$image_list = array();

while (($query = $image_list_query->fetch())) {
    array_push($image_list, $query);
}

$user_image_list_query = $bdd->prepare("SELECT * FROM user_images WHERE user_id=$_SESSION[user_id];");
$user_image_list_query->execute();


?>