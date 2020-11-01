<?php
function get_connection() {
    include "config/database.php";
    try {
        $conn = new PDO("mysql:host=localhost;dbname=$DB_DSN", $DB_USER, $DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ($conn);
    } catch(PDOException $e) {
        return (null);
    }
}
?>