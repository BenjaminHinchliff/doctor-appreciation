<?php

$mysqli = new mysqli("localhost", "root", "", "supportive_entries");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySql Database: " . $mysqli->connect_error;
    exit();
}

$res = $mysqli->query("SELECT `enterer`, `timestamp`, `content` FROM `entries` ORDER BY RAND()");
if(!$res) {
    echo "Failed to query mysql database: " . $mysqli->error;
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