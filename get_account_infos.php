<?php
include "database/mysql_connect.php";
$bdd = get_connection();
$stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_SESSION[user]';");
$stmt->execute();

$user_infos = $stmt->fetch();

?>