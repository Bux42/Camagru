<?php
include "database/mysql_connect.php";

if (($bdd = get_connection()) == null) {
    echo "Init database with setup.php";
} else {
    include "home.php";
}
?>