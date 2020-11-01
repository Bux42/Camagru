<?php
include "database/mysql_connect.php";
session_start();
$_SESSION["registration_error"] = array();

function checkUsername() {
    if (isset($_POST["username"]) && strlen($_POST["username"]) > 0) {
        if (strlen($_POST["username"]) < 3) {
            array_push($_SESSION["registration_error"], "Username must be at least 3 characters");
        } else if (strlen($_POST["username"]) > 15) {
            array_push($_SESSION["registration_error"], "Username length must be under 16 characters");
        }
        if (!ctype_alnum($_POST["username"])) {
            array_push($_SESSION["registration_error"], "Invalid characters in username");
        }
    } else {
        array_push($_SESSION["registration_error"], "You must specify an username");
    }
}

function checkTakenUsername() {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_POST[username]';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        array_push($_SESSION["registration_error"], "Username already in use");
    }
}

function checkTakenEmail() {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE email='$_POST[email]';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        array_push($_SESSION["registration_error"], "Email already in use");
    }
}

function checkPassword() {
    if (isset($_POST["password"]) && strlen($_POST["password"]) > 0) {
        if (strlen($_POST["password"]) < 3) {
            array_push($_SESSION["registration_error"], "Password must be at least 3 characters");
        } else if (strlen($_POST["password"]) > 15) {
            array_push($_SESSION["registration_error"], "Password length must be under 16 characters");
        }
    } else {
        array_push($_SESSION["registration_error"], "You must specify an password");
    }
}

function checkEmail() {
    if (isset($_POST["email"]) && strlen($_POST["email"]) > 0) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            array_push($_SESSION["registration_error"], "Invalid email address");
        }
    } else {
        array_push($_SESSION["registration_error"], "You must specify an email");
    }
}

function createAccount() {
    $bdd = get_connection();
    $hashed_pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $mail_url = password_hash($_POST["email"], PASSWORD_DEFAULT);
    $stmt = $bdd->prepare("INSERT INTO users (username, email, password, verified, mail_url) VALUES ('$_POST[username]', '$_POST[email]', '$hashed_pass', 0, '$mail_url');");
    $stmt->execute();

    $message = '
    <html>
    <head>
    <title>Camagru email verification</title>
    </head>
    <body>
    <p>Camagru email verification</p>
    <a href="http://localhost/verify_mail?key='.$hashed_pass.'&username='.$_POST["username"].'">Click this link to verify your mail</a>
    </body>
    </html>';

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //mail($_POST["email"], 'Camagru email verification', $message, $headers);
}

checkUsername();
checkPassword();
checkEmail();

if (count($_SESSION["registration_error"]) == 0) {
    checkTakenUsername();
    checkTakenEmail();
}

if (count($_SESSION["registration_error"]) == 0) {
    createAccount();
    $_SESSION["registration_success"] = $_POST["username"];
    header('Location: /login.php');
} else {
    header('Location: /register.php');
}
?>