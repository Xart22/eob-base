$(document).ready(function () {
    $(".alert").fadeOut(12500);
    $("#summernote").summernote({
        focus: true,
        height: 200,
    });
    $("#upload").ajaxForm({
        beforeSend: function () {
            var percentage = "0";
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentage = percentComplete;
            $(".progress .progress-bar").css(
                "width",
                percentage + "%",
                function () {
                    return $(this).attr("aria-valuenow", percentage) + "%";
                }
            );
        },
        complete: function (xhr) {
            if (xhr.responseJSON.code == 200) {
                location.replace(xhr.responseJSON.url);
            }
            if (xhr.responseJSON.code == 400) {
                let message = xhr.responseJSON.message;
                console.log(message);
                if (Array.isArray(message)) {
                    $(".alert-danger").show();
                    $.each(message, function (i, v) {
                        $("#showErr").append("<li>" + v + "</lin>");
                    });
                } else if (message.includes("ebook_ebook_name")) {
                    $(".alert-danger").show();
                    $("#showErr").append("<li>ebook Name Already Exist</lin>");
                } else if (message.includes("movie_movie_name")) {
                    $(".alert-danger").show();
                    $("#showErr").append("<li>Movie Name Already Exist</lin>");
                } else if (message.includes("movie_music_name")) {
                    $(".alert-danger").show();
                    $("#showErr").append("<li>Movie Name Already Exist</lin>");
                } else if (message.includes("movie_game_name")) {
                    $(".alert-danger").show();
                    $("#showErr").append("<li>Movie Name Already Exist</lin>");
                } else {
                    $(".alert-danger").show();
                    $("#showErr").append("<li>" + message + "</lin>");
                }
            }
        },
    });
});
function deleteItem(e) {
    let uuid = $(e).data("bookId");
    let action = $("#formDelete").attr("action").replace("0", uuid);
    $("#formDelete").attr("action", action);
}
function updateItem(e) {
    let uuid = $(e).data("bookId");
    let action = $("#formUpdate").attr("action").replace("0", uuid);
    $("#formUpdate").attr("action", action);
}
function detailItem(e) {
    let title = $(e).data("title");
    let img = $(e).data("img");
    let content = $(e).data("content");
    $("#imgHeader").attr("src", "");
    $("#imgHeader").attr("src", img);
    $("#content").append("<h4>" + title + "</h4>");
    $("#content").append(content);
}
$("#closeBtn").click(function (e) {
    e.preventDefault();
    $("#imgHeader").attr("src", "");
    $("#content").empty();
    $("#content").empty();
});
