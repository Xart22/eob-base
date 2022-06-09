$("#rating").on("input", () => {
    const value = $("#rating");
    value.next().hide();
    if (value.val() > 10) {
        value.val("");
        value.next().show();
    }
});

window.URL = window.URL || window.webkitURL;

$("input[name=movie_file]").change(function (e) {
    e.preventDefault();
    var files = this.files;
    var video = document.createElement("video");
    video.preload = "metadata";

    video.onloadedmetadata = function () {
        window.URL.revokeObjectURL(video.src);
        $("input[name=movie_duration]").val(video.duration);
    };
    video.src = URL.createObjectURL(files[0]);
});
$(document).on("click", '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        showArrows: true,
        wrapping: true,
    });
});
