$(document).ready(function(){

    $("#new-post").on("click", function() {
        $("#new-post-author, #new-post-title, #new-post-content").val("");
        $("#new-post-modal").modal("show");
    });

    $("#submit-new-post").on("click", function() {
        if ($("#new-post-author").val() != "" && $("#new-post-author").val().toLowerCase() != "admin" && $("#new-post-title").val() != "") {
            jQuery.ajax({
                type : "POST",
                url : "functions.php",
                dataType : "json",
                data : {functionname : "new_post", arguments : [$("#new-post-author").val(), $("#new-post-title").val(), $("#new-post-content").val()]},
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

});