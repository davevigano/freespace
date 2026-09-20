<?php
    include_once('db.php');
    include_once('helpers.php');

    $comment_counts = [];
    $count_result = $db->query("SELECT post_code, COUNT(*) AS comment_count FROM comment GROUP BY post_code");
    if ($count_result) {
        while ($row = $count_result->fetch_assoc()) {
            $comment_counts[$row['post_code']] = $row['comment_count'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>freespace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700;800;900&family=Libre+Franklin:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="modal fade" tabindex="-1" id="error-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Whoops!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Something went definitely wrong!  
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="new-post-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new-post-author" class="form-label">Author <small class="req">*</small></label>
                            <input type="text" class="form-control" id="new-post-author" aria-describedby="author-max" maxlength="20">
                            <div id="author-max" class="form-text">Max. 20 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="new-post-title" class="form-label">Title <small class="req">*</small></label>
                            <textarea type="text" class="form-control" id="new-post-title" aria-describedby="title-max" maxlength="250"></textarea>
                            <div id="title-max" class="form-text">Max. 250 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="new-post-content" class="form-label">Content</label>
                            <textarea type="text" class="form-control" id="new-post-content" aria-describedby="content-max" maxlength="2000"></textarea>
                            <div id="content-max" class="form-text">Max. 2000 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="new-post-tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="new-post-tags" aria-describedby="tags-max" maxlength="50">
                            <div id="tags-max" class="form-text">Max. 50 characters. Write every tag separated by a comma, without spaces.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                        <button type="button" class="btn btn-success" id="submit-new-post">Post</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="comments-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Comments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="new-comment">Post a comment</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="new-comment-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new-comment-author" class="form-label">Author <small class="req">*</small></label>
                            <input type="text" class="form-control" id="new-comment-author" aria-describedby="author-max" maxlength="20">
                            <div id="author-max" class="form-text">Max. 20 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="new-comment-content" class="form-label">Content <small class="req">*</small></label>
                            <textarea type="text" class="form-control" id="new-comment-content" aria-describedby="content-max" maxlength="2000"></textarea>
                            <div id="content-max" class="form-text">Max. 2000 characters</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                        <button type="button" class="btn btn-success" id="submit-new-comment">Post</button>
                    </div>
                </div>
            </div>
        </div>
        <header class="masthead">
            <div class="masthead-inner">
                <div class="masthead-brand">
                    <h1 class="masthead-wordmark">freespace</h1>
                    <span class="masthead-tagline">no accounts &middot; no moderation &middot; just pure fun</span>
                </div>
                <div class="masthead-controls">
                    <label class="switch" title="Toggle dark mode">
                        <input type="checkbox" id="dark-mode">
                        <span class="slider round"><i class="fa fa-sun-o icon-sun"></i><i class="fa fa-moon-o icon-moon"></i></span>
                    </label>
                    <a class="masthead-github" href="https://github.com/davevigano/freespace" target="_blank"><i class="fa fa-github"></i></a>
                </div>
            </div>
        </header>
        <div class="container-fluid" id="feed">
            <?php
                $sql = "SELECT * FROM post ORDER BY post_creation_time DESC";
                $result = $db->query($sql);
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $tags = ($row['post_tags'] !== null && $row['post_tags'] !== '') ? explode(",", $row['post_tags']) : [];
                            $post_time = strtotime($row['post_creation_time']);
                            $datetime = date("j M, Y", $post_time)." · ".date("H:i", $post_time);
                            $comment_count = isset($comment_counts[$row['post_id']]) ? $comment_counts[$row['post_id']] : 0;

                            $html = "<div class=\"card\"><div class=\"card-body\">";
                            $html .= "<div class=\"card-head\">";
                            $html .= "<h5 id=\"".$row['post_id']."\" class=\"card-title\">".h($row["post_title"])."</h5>";
                            if (count($tags) > 0) {
                                $html .= "<div class=\"card-tags\">";
                                foreach ($tags as $tag) {
                                    $html .= "<span class=\"tag-stamp\">".h($tag)."</span>";
                                }
                                $html .= "</div>";
                            }
                            $html .= "</div>";
                            $html .= "<div class=\"card-meta\">";
                            $html .= "<span class=\"meta-author\">by ".h($row["post_author"])."</span>";
                            $html .= "<span class=\"meta-time\"><i class=\"fa fa-clock-o\"></i>".$datetime."</span>";
                            $html .= "</div>";
                            $html .= "<p class=\"card-text\">".h($row["post_content"])."</p>";
                            $html .= "</div><div class=\"card-footer\">";
                            $html .= "<div class=\"footer-reactions\">";
                            $html .= "<div id=\"like-container\"><a href=\"#\" class=\"like-btn\"><i class=\"fa fa-thumbs-up\"></i></a><span class=\"count\">".$row['post_likes']."</span></div>";
                            $html .= "<div id=\"dislike-container\"><a href=\"#\" class=\"dislike-btn\"><i class=\"fa fa-thumbs-down\"></i></a><span class=\"count\">".$row['post_dislikes']."</span></div>";
                            $html .= "</div>";
                            $html .= "<a href=\"#\" class=\"comments-btn\"><i class=\"fa fa-comments\"></i><span class=\"count\">".$comment_count."</span></a>";
                            $html .= "</div></div>";
                            echo($html);
                        }
                    } else { echo("<p class=\"empty-state\">There seems to be nothing here&hellip;</p>"); }
                } else { echo("<p class=\"empty-state\">Something went wrong&hellip;</p>"); }
            ?>
        </div>
        <a href="#" class="float" id="new-post" title="New post">
            <i class="fa fa-plus"></i>
        </a>
        <footer class="site-footer">
            <div class="site-footer-inner">
                <span>freespace is free and open source, made by <a href="https://github.com/davevigano" target="_blank">@davevigano</a>. Check the repo on <a href="https://github.com/davevigano/freespace" target="_blank">GitHub</a>.</span>
                <span>Find the LICENSE <a href="https://raw.githubusercontent.com/davevigano/freespace/main/LICENSE" target="_blank">here</a>.</span>
            </div>
        </footer>
    </body>
</html>