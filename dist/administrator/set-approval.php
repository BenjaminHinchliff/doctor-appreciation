<?php

    list("host" => $host,
        "username" => $username,
        "password" => $password,
        "database" => $database
        ) = json_decode(file_get_contents("../api/credentials.json"), true);
    $mysqli = new mysqli($host, $username, $password, $database);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySql Database: " . $mysqli->connect_error;
        exit();
    }

    $req = $mysqli->prepare("UPDATE `entries` SET `approved` = ?, `reviewed` = 1 WHERE `entries`.`id` = ?");
    $req->bind_param("ii", $_GET["state"], $_GET["id"]);
    $req->execute();

?>