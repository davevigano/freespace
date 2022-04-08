$(document).ready(function(){

    $("#new-post").on("click", function(e) {
        e.preventDefault();
        $("#new-post-author, #new-post-title, #new-post-content").val("");
        $("#new-post-modal").modal("show");
    });

    $("#submit-new-post").on("click", function() {
        if ($("#new-post-author").val() != "" && $("#new-post-author").val().toLowerCase() != "admin" && $("#new-post-title").val() != "") {
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "new_post", arguments : [$("#new-post-author").val(), $("#new-post-title").val(), $("#new-post-content").val(), $("#new-post-tags").val()]},
            });
            setTimeout(() => { location.reload(); }, 250);
        } else {
            $("#new-post-modal").modal("hide");
            $("#error-modal").modal("show");
        }
    });

    $("#dark-mode").on("click", function() {
        if ($("body").css("background-color") == "rgb(33, 37, 41)") {
            $("body").css("background-color", "#fff");
        } else {
            $("body").css("background-color", "#212529");
        }
    });

    $(".like-btn").on("click", function(e) {
        e.preventDefault();
        post_id = $(this).closest(".card-footer").closest(".card").find(".card-body").find(".card-title").attr("id");
        if (!$(this).find("i").hasClass("like-active")) {
            $(this).find("i").addClass("like-active");
            $(this).closest("#like-container").find("span").html(String(parseInt($(this).closest("#like-container").find("span").html()) + 1));
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "edit_like", arguments : ["add", post_id]},
            });
            dislike = $(this).closest(".card-footer").find("#dislike-container");
            if (dislike.find("i").hasClass("dislike-active")) {
                dislike.find("i").removeClass("dislike-active");
                dislike.find("span").html(String(parseInt(dislike.find("span").html()) - 1));
                jQuery.ajax({
                    type : "POST",
                    url : "functions.php",
                    dataType : "json",
                    data : {functionname : "edit_dislike", arguments : ["remove", post_id]},
                });
            }
        } else {
            $(this).find("i").removeClass("like-active");
            $(this).closest("#like-container").find("span").html(String(parseInt($(this).closest("#like-container").find("span").html()) - 1));
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "edit_like", arguments : ["remove", post_id]},
            });
        }
    });

    $(".dislike-btn").on("click", function(e) {
        e.preventDefault();
        post_id = $(this).closest(".card-footer").closest(".card").find(".card-body").find(".card-title").attr("id");
        if (!$(this).find("i").hasClass("dislike-active")) {
            $(this).find("i").addClass("dislike-active");
            $(this).closest("#dislike-container").find("span").html(String(parseInt($(this).closest("#dislike-container").find("span").html()) + 1));
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "edit_dislike", arguments : ["add", post_id]},
            });
            like = $(this).closest(".card-footer").find("#like-container");
            if (like.find("i").hasClass("like-active")) {
                like.find("i").removeClass("like-active");
                like.find("span").html(String(parseInt(like.find("span").html()) - 1));
                jQuery.ajax({
                    type : "POST",
                    url : "functions.php",
                    dataType : "json",
                    data : {functionname : "edit_like", arguments : ["remove", post_id]},
                });
            }
        } else {
            $(this).find("i").removeClass("dislike-active");
            $(this).closest("#dislike-container").find("span").html(String(parseInt($(this).closest("#dislike-container").find("span").html()) - 1));
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "edit_dislike", arguments : ["remove", post_id]},
            });
        }
    });

    $(".comments-btn").on("click", function(e) {
        e.preventDefault();
        jQuery.ajax({
            type : "POST",
            url : "functions.php",
            dataType : "json",
            data : {functionname : "show_comments", arguments : [$(this).closest(".card").find(".card-body").find(".card-title").attr("id")]},
            success: function(html) {
                $("#comments-modal").find(".modal-body").html(html);
                $("#comments-modal").modal("show");
            }
        });
    });

    $("#new-comment").on("click", function() {
        $("#comments-modal").modal("hide");
        $("#new-comment-author, #new-comment-content").val("");
        $("#new-comment-modal").modal("show");
    });

    $(document).on("click", "#submit-new-comment", function() {
        if ($("#new-comment-author").val() != "" && $("#new-comment-author").val().toLowerCase() != "admin" && $("#new-comment-content").val() != "") {
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "new_comment", arguments : [$("#new-comment-author").val(), $("#new-comment-content").val(), $("#post-id").val()]},
            });
            setTimeout(() => { location.reload(); }, 250);
        } else {
            $("#new-comment-modal").modal("hide");
            $("#error-modal").modal("show");
        }
    });

});