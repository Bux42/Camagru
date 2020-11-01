<?php
include "database/mysql_connect.php";
session_start();
$_SESSION["login_error"] = array();

function checkUsername() {
    if (!isset($_POST["username"]) || strlen($_POST["username"]) < 1) {
        array_push($_SESSION["login_error"], "You must specify an username");
    }
}

function checkPassword() {
    if (!isset($_POST["password"]) || strlen($_POST["password"]) < 1) {
        array_push($_SESSION["login_error"], "You must specify an password");
    }
}

function loginAccount() {
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM users WHERE username='$_POST[username]';");
    $stmt->execute();
    if (($query = $stmt->fetch())) {
        if (password_verify($_POST["password"], $query["password"])) {
            $_SESSION["user"] = $_POST["username"];
           
        } else {
            array_push($_SESSION["login_error"], "Wrong password");
        }
    } else {
        array_push($_SESSION["login_error"], "Username not found");
    }
}

checkUsername();
checkPassword();

if (count($_SESSION["login_error"]) == 0) {
    loginAccount();
}
if (count($_SESSION["login_error"]) == 0) {
    header('Location: /index.php');
} else {
    header('Location: /login.php');
}
?>