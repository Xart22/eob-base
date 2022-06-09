$(document).ready(function () {
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
                if (Array.isArray(message)) {
                    $(".alert-danger").show();
                    $.each(message, function (i, v) {
                        $("#showErr").append("<li>" + v + "</lin>");
                    });
                } else {
                    if (message.includes("ebook_ebook_name")) {
                        $(".alert-danger").show();
                        $("#showErr").append(
                            "<li>ebook Name Already Exist</lin>"
                        );
                    } else {
                        $(".alert-danger").show();
                        $("#showErr").append("<li>" + message + "</lin>");
                    }
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
