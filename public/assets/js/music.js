window.URL = window.URL || window.webkitURL;

$("input[name=music_file]").change(function (e) {
    e.preventDefault();

    var file = this.files[0];
    var objectURL = URL.createObjectURL(file);
    var mySound = new Audio([objectURL]);
    mySound.addEventListener("canplaythrough", () => {
        URL.revokeObjectURL(objectURL);
        $("input[name=music_duration]").val(mySound.duration);
    });
});
