<?php
include "database/mysql_connect.php";
session_start();

if (isset($_SESSION["user_id"])) {
    $_SESSION["send_verification_mail"] = "A verification mail has been sent";
    $mail_url = password_hash($_SESSION["user_mail"], PASSWORD_DEFAULT);
    $message = '
    <html>
    <head>
    <title>Camagru email verification</title>
    </head>
    <body>
    <p>Camagru email verification</p>
    <a href="http://localhost/verify_mail?key='.$mail_url.'&username='.$_SESSION["user"].'">Click this link to verify your mail</a>
    </body>
    </html>';

    $headers = "From: camagru@localhost.com \r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
 	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    echo 'http://localhost/verify_mail?key='.$mail_url.'&username='.$_SESSION["user"];

    var_dump(mail($_SESSION["user_mail"], 'Camagru email verification', $message, $headers));

    $bdd = get_connection();
    $stmt = $bdd->prepare("UPDATE users SET mail_url='$mail_url' WHERE id=$_SESSION[user_id];");
    $stmt->execute();
    header('Location: /account.php');
}
?>