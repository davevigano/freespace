<?php
    include_once('db.php');

    function new_post($author, $title, $content, $tags) {
        global $db;
        $stmt = $db->prepare("INSERT INTO post (post_id, post_title, post_content, post_author, post_tags, post_creation_time) VALUES (Null, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $title, $content, $author, $tags);
        $stmt->execute();
    }

    function edit_like($action, $post_id) {
        global $db;
        $post_id = (int)$post_id;
        if ($action == "add") {
            $stmt = $db->prepare("UPDATE post SET post_likes = post_likes + 1 WHERE post_id = ?");
        } else {
            $stmt = $db->prepare("UPDATE post SET post_likes = post_likes - 1 WHERE post_id = ?");
        }
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
    }

    function edit_dislike($action, $post_id) {
        global $db;
        $post_id = (int)$post_id;
        if ($action == "add") {
            $stmt = $db->prepare("UPDATE post SET post_dislikes = post_dislikes + 1 WHERE post_id = ?");
        } else {
            $stmt = $db->prepare("UPDATE post SET post_dislikes = post_dislikes - 1 WHERE post_id = ?");
        }
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
    }

    function show_comments($post_id) {
        global $db;
        $post_id = (int)$post_id;
        $stmt = $db->prepare("SELECT * FROM comment WHERE post_code = ? ORDER BY comment_creation_time DESC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            if ($result->num_rows > 0) {
                $html = "<input type=\"hidden\" id=\"post-id\" value=\"".$post_id."\">";
                while ($row = $result->fetch_assoc()) {
                    $html .= "<div class=\"card\"><div class=\"card-body\">";
                    $html .= "<h6 class=\"card-subtitle mb-2 text-muted d-inline-block\">".$row['comment_author']."</h6>";
                    $datetime = date("j M, Y - H:i:s", strtotime($row['comment_creation_time']));
                    $html .= "<h6 class=\"card-subtitle mb-2 text-muted d-inline-block\" style=\"float:right;\"><i class=\"fa fa-clock-o\"></i>&nbsp;&nbsp;".$datetime."</h6>";
                    $html .= "<p class=\"card-text\">".$row['comment_content']."</p>";
                    $html .= "</div></div><br>";
                }
                echo(json_encode($html));
            } else { echo(json_encode("<input type=\"hidden\" id=\"post-id\" value=\"".$post_id."\"><h3 class=\"text-muted\">There seems to be nothing here...</h1>")); }
        } else { echo(json_encode("<input type=\"hidden\" id=\"post-id\" value=\"".$post_id."\"><h3 class=\"text-muted\">Something went wrong...</h1>")); }
    }

    function new_comment($author, $content, $post_id) {
        global $db;
        $post_id = (int)$post_id;
        $stmt = $db->prepare("INSERT INTO comment (comment_id, comment_content, comment_author, comment_creation_time, post_code) VALUES (Null, ?, ?, NOW(), ?)");
        $stmt->bind_param("ssi", $content, $author, $post_id);
        $stmt->execute();
    }

    if (isset($_POST['functionname'])) {
        switch ($_POST['functionname']) {
            case "new_post":
                if ($_POST['arguments'][2] != "" && $_POST['arguments'][3] != "") {
                    new_post($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2], $_POST['arguments'][3]);
                } else if ($_POST['arguments'][2] != "") {
                    new_post($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2], Null);
                } else if ($_POST['arguments'][3] != "") {
                    new_post($_POST['arguments'][0], $_POST['arguments'][1], Null, $_POST['arguments'][3]);
                } else {
                    new_post($_POST['arguments'][0], $_POST['arguments'][1], Null, Null);
                }
                break;
            case "edit_like":
                edit_like($_POST['arguments'][0], $_POST['arguments'][1]);
                break;
            case "edit_dislike":
                edit_dislike($_POST['arguments'][0], $_POST['arguments'][1]);
                break;
            case "show_comments":
                show_comments($_POST['arguments'][0]);
                break;
            case "new_comment":
                new_comment($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2]);
                break;
            default:
                break;
        }
    }
?>
