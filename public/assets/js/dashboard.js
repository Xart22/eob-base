const url = $("#locationUrl").val();
const interval = $("#interval").val() * 1000;

$(document).ready(function () {
    updateLocation();
});
setInterval(() => {
    updateLocation();
}, interval);

function updateLocation() {
    $.get(url)
        .done((res) => {
            console.log(res);
            const destionation =
                res.location_name[res.location_name.length - 1];
            const speed = res.speed;
            const location = res.position;
            const eta = res.eta;

            $("#speed").text(speed + " Km/j");
            $("#location").text(location);
            $("#destination").text(destionation);
            $.map($(".input span"), function (v, i) {
                const travelTime = moment()
                    .add(eta[i], "minutes")
                    .format("hh:mm");
                $(v).attr("data-year", travelTime);
            });
        })
        .fail((err) => {
            console.log(err);
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
