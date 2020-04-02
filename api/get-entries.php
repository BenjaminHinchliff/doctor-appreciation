<?php

list("host" => $host,
    "username" => $username,
    "password" => $password,
    "database" => $database
    ) = json_decode(file_get_contents("credentials.json"), true);
$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySql Database: " . $mysqli->connect_error;
    exit();
}

$res = $mysqli->query("SELECT `enterer`, `timestamp`, `content` FROM `entries` WHERE `approved` = TRUE ORDER BY RAND()");
if(!$res) {
    echo "Failed to query mysql database";
    exit();
}

$out = array();
while($row = $res->fetch_assoc()) {
    $out[] = $row;
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
echo json_encode($out);

?>