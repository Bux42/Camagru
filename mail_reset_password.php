<?php
include "database/mysql_connect.php";
session_start();
$_SESSION["mail_reset_password_error"] = "Invalid input";

if (isset($_POST["email"])) {
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
        $stmt->execute();

        if (($query = $stmt->fetch())) {
            unset($_SESSION["mail_reset_password_error"]);
            $mail_url = password_hash($_POST["email"], PASSWORD_DEFAULT);
            $stmt = $bdd->prepare("UPDATE users SET reset_url='$mail_url' WHERE email='$_POST[email]';");
            $stmt->execute();

            $message = '
            <html>
            <head>
            <title>Camagru password reset</title>
            </head>
            <body>
            <p>Camagru password reset</p>
            <a href="http://localhost/reset_password.php?key='.$mail_url.'">Click this link to reset your password</a>
            </body>
            </html>';

            $headers = "From: camagru@localhost.com \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            mail($_POST["email"], 'Camagru password reset', $message, $headers);

            $_SESSION["mail_reset_password"] = "Success";
        } else {
            $_SESSION["mail_reset_password_error"] = "Unknown mail";
        }
    }
}
header('Location: /forgot_password.php');
?>