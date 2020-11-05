<?php
include "database/mysql_connect.php";

if (isset($_GET["index"])) {
    $result;

    $result["images"] = array();
    $result["index"] = intval($_GET["index"]);

    $index = intval($_GET["index"]);
    if ($index === -1) {
        $index = PHP_INT_MAX;
    }
    $bdd = get_connection();
    $stmt = $bdd->prepare("SELECT * FROM user_images WHERE id<$index ORDER BY dateadded DESC LIMIT 9;");
    $stmt->execute();
    while (($query = $stmt->fetch())) {
        //$query["base64_img"] = "";
        //$query[1] = "";
        array_push($result["images"], $query);
        $result["index"] = $query["id"];
    }
    echo json_encode($result);
}
?>