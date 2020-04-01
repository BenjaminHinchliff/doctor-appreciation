<?php

$mysqli = new mysqli("localhost", "root", "", "supportive_entries");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySql Database: " . $mysqli->connect_error;
    exit();
}

$res = $mysqli->query("SELECT `enterer`, `timestamp`, `content` FROM `entries`");
if(!$res) {
    echo "Failed to query mysql database: " . $mysqli->error;
    exit();
}

$out = array();
while($row = $res->fetch_assoc()) {
    $out[] = $row;
}

header("Content-Type: application/json");
echo json_encode($out);

?>