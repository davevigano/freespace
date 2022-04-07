<?php
    $host = "localhost";
    $dbname = "freespace-db";
    $user = "freespace";
    $psw = "freespace-db";
    $db = new mysqli($host, $user, $psw, $dbname);
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    function new_post($author, $title, $content) {
        global $db;
        $sql = "INSERT INTO post (post_id, post_title, post_content, post_author, post_creation_time) VALUES (Null, '".$title."', '".$content."', '".$author."', NOW())";
        $db->query($sql);
    }

    if (isset($_POST['functionname'])) {
        switch ($_POST['functionname']) {
            case "new_post":
                if ($_POST['arguments'][2] != "") {
                    new_post($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2]);
                } else {
                    new_post($_POST['arguments'][0], $_POST['arguments'][1], Null);
                }
                break;
            default:
                break;
        }
    }
?>