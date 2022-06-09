$(document).ready(function () {
    updateLocation();
});
// const player = new JSMpeg.Player("ws://localhost:9090", {
//     autoplay: true,
// });
setInterval(() => {
    $.get("/public/app/nvr/location", (res) => {
        const destionation = res.location_name[res.location_name.length - 1];
        const speed = res.speed;
        const location = res.position;
        const eta = res.eta;

        $("#speed").text(speed + " Km/j");
        $("#location").text(location);
        $("#destination").text(destionation);
        $.map($(".input span"), function (v, i) {
            const travelTime = moment().add(eta[i], "minutes").format("hh:mm");
            $(v).attr("data-year", travelTime);
        });
    });
}, 1000);

function updateLocation() {
    $.get("/public/app/nvr/location", (res) => {
        const destionation = res.location_name[res.location_name.length - 1];
        const speed = res.speed;
        const location = res.position;
        const eta = res.eta;

        $("#speed").text(speed + " Km/j");
        $("#location").text(location);
        $("#destination").text(destionation);
        $.map($(".input span"), function (v, i) {
            if (eta[i] == 0) {
                $(v).attr("data-year", "Passed");
                $(v).parent().addClass("active");
            } else {
                const travelTime = moment()
                    .add(eta[i], "minutes")
                    .format("hh:mm");
                $(v).attr("data-year", "ETA: " + travelTime);
            }
        });
    });
}

$("#delete").click(function (e) {
    e.preventDefault();
    $.get("public/api/stream/info-delete")
        .then((res) => {
            res.code == 200 ? location.reload(true) : false;
        })
        .catch((err) => {
            console.log(err);
        });
});
