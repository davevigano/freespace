<?php
    include_once('db.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                            <label for="new-post-author" class="form-label">Author <small style="color:#ff0000;">*</small></label>
                            <input type="text" class="form-control" id="new-post-author" aria-describedby="author-max" maxlength="20">
                            <div id="author-max" class="form-text">Max. 20 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="new-post-title" class="form-label">Title <small style="color:#ff0000;">*</small></label>
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
                            <label for="new-comment-author" class="form-label">Author <small style="color:#ff0000;">*</small></label>
                            <input type="text" class="form-control" id="new-comment-author" aria-describedby="author-max" maxlength="20">
                            <div id="author-max" class="form-text">Max. 20 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="new-comment-content" class="form-label">Content <small style="color:#ff0000;">*</small></label>
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
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand">freespace</span>
                <span class="navbar-brand" style="float:right;"><a href="https://github.com/davevigano/freespace" target="_blank"><i class="fa fa-github"></i></a></span>
                <span class="navbar-brand" style="float:right;">
                    <i class="fa fa-sun-o"></i>&nbsp;
                    <label class="switch">
                        <input type="checkbox" id="dark-mode">
                        <span class="slider round"></span>
                    </label>
                    &nbsp;<i class="fa fa-moon-o"></i>
                </span>
            </div>
        </nav>
        <br>
        <div class="container-fluid" id="feed">
            <?php
                $sql = "SELECT * FROM post ORDER BY post_creation_time DESC";
                $result = $db->query($sql);
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $html = "<div class=\"card\"><div class=\"card-body\">";
                            $html .= "<h5 id=\"".$row['post_id']."\" class=\"card-title d-inline-block\">".$row['post_title']."</h5>&nbsp;&nbsp;";
                            $tags = explode(",", $row['post_tags']);
                            foreach ($tags as $tag) {
                                $html .= "<h6 class=\"card-subtitle d-inline-block\"><span class=\"badge bg-primary\">".$tag."</span></h6>&nbsp;";
                            }
                            $datetime = date("j M, Y - H:i:s", strtotime($row['post_creation_time']));
                            $html .= "<h6 class=\"card-subtitle mb-2 text-muted d-inline-block\" style=\"float:right;\"><i class=\"	fa fa-clock-o\"></i>&nbsp;&nbsp;".$datetime."</h5>";
                            $html .= "<h6 class=\"card-subtitle mb-2 text-muted\">by ".$row['post_author']."</h6>";
                            $html .= "<p class=\"card-text\">".$row['post_content']."</p>";
                            $html .= "</div><div class=\"card-footer\">";
                            $html .= "<div id=\"like-container\" class=\"d-inline-block\"><a href=\"#\" class=\"like-btn\"><i class=\"fa fa-thumbs-up\">&nbsp;</i></a><span class=\"count\">".$row['post_likes']."</span></div>&nbsp;&nbsp;";
                            $html .= "<div id=\"dislike-container\" class=\"d-inline-block\"><a href=\"#\" class=\"dislike-btn\"><i class=\"fa fa-thumbs-down\">&nbsp;</i></a><span class=\"count\">".$row['post_dislikes']."</span></div>";
                            $html .= "<a href=\"#\" class=\"comments-btn\" style=\"float:right;\"><i class=\"fa fa-comments\"></i></a>";
                            $html .= "</div></div><br>";
                            echo($html);
                        }
                    } else { echo("<h1 class=\"text-muted\">There seems to be nothing here...</h1>"); }
                } else { echo("<h1 class=\"text-muted\">Something went wrong...</h1>"); }
            ?>
        </div>
        <a href="#" class="float" id="new-post">
            <i class="fa fa-plus my-float"></i>
        </a>
        <footer class="footer mt-auto py-3 bg-dark">
            <div class="container">
                <span class="text-muted">Freespace is a free and open source social network made by @davevigano. Check the repo on <a href="https://github.com/davevigano/freespace" target="_blank" style="text-decoration:underline !important;">GitHub</a>.</span>
                <span class="text-muted">Find the LICENSE <a href="https://raw.githubusercontent.com/davevigano/freespace/main/LICENSE" target="_blank" style="text-decoration:underline !important;">here</a>.</span>
            </div>
        </footer>
    </body>
</html>