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
        <title>Administrator Panel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        </script>
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