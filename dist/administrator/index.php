<!-- I know this page is janky. but users don't see it. So I can't be bothered to make it nice -->
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

if (array_key_exists("state", $_GET) && array_key_exists("id", $_GET)) {
    $req = $mysqli->prepare("UPDATE `entries` SET `approved` = ?, `reviewed` = 1 WHERE `entries`.`id` = ?");
    $req->bind_param("ii", $_GET["state"], $_GET["id"]);
    $req->execute();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-language" content="en-us">
        <!-- favicon stuff -->
        <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
        <link rel="manifest" href="/icon/site.webmanifest">
        <link rel="mask-icon" href="/icon/safari-pinned-tab.svg" color="#ff0000">
        <link rel="shortcut icon" href="/icon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/icon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <!-- end favicon stuff -->
        <title>Administrator Panel</title>
    </head>
    <body>
        <div class="container-xl content">
            <div class="jumbotron my-1 bg-primary">
                <h1>Requests that need approval:</h1>
            </div>
            <div class="container-flex bg-primary p-1 rounded">
                <table>
                    <?php                
                        $res = $mysqli->query("SELECT `id`, `enterer`, `content` FROM `entries` WHERE `reviewed` = FALSE");

                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_assoc()) {
                                echo '<tr>';
                                echo '    <td class="w-25 border border-secondary">' . htmlspecialchars($row["enterer"]) . '</td>';
                                echo '    <td class="w-50 border border-secondary">' . htmlspecialchars($row["content"]) . '</td>';
                                echo '    <td class="border border-secondary"><button class="approve" id="' . $row["id"] . '">approve</button></td>';
                                echo '    <td class="border border-secondary"><button class="disapprove" id="' . $row["id"] . '">disapprove</button></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td>All requests reviewed</td></tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
        <script src="admin.bundle.js"></script>
    </body>
</html>