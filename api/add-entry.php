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

if (!array_key_exists("enterer", $_POST) || !array_key_exists("content", $_POST)) {
    http_response_code(404);
    echo json_encode("keys 'enterer', 'content', and 'OTP' must be defined in the post query");
    exit();
}

$req = $mysqli->prepare("INSERT INTO `entries` (`enterer`, `content`) VALUES (?, ?)");
$req->bind_param("ss", $_POST["enterer"], $_POST["content"]);
$req->execute();

header("Location: http://localhost:9000/");

?>