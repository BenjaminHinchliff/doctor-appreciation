<!-- I know this page is janky. but users don't see it. So I can't be bothered to make it nice -->
<!DOCTYPE html>
<html>
    <head>
        <title>Administrator Panel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            function setApproval(id, state) {
                $.get("set-approval.php", { id, state }).done(() => {
                    location.reload();
                });
            }
        </script>
    </head>
    <body>
        <h1>Requests that need approval:</h1>
        <table>
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
            
                $res = $mysqli->query("SELECT `id`, `enterer`, `content` FROM `entries` WHERE `reviewed` = FALSE");

                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo '<tr>';
                        echo '    <td style="border-right: 1px solid black;">' . htmlspecialchars($row["enterer"]) . '</td>';
                        echo '    <td>' . htmlspecialchars($row["content"]) . '</td>';
                        echo '    <td><button onclick="setApproval(' . $row["id"]  . ', 1)">approve</button></td>';
                        echo '    <td><button onclick="setApproval(' . $row["id"]  . ', 0)">disapprove</button></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td>All requests reviewed</td></tr>';
                }
            ?>
        </table>
    </body>
</html>