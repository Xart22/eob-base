const url = $("#locationUrl").val();
const interval = $("#interval").val() * 1000;

$(document).ready(function () {
    //socket.emit("message", "gps");
    updateLocation();
    $(".js-flickity").flickity({
        contain: true,
        prevNextButtons: false,
    });
});

setInterval(() => {
    updateLocation();
}, interval);
function updateLocation() {
    $.get(url)
        .done((res) => {
            const destionation =
                res.location_name[res.location_name.length - 1];
            const locationName = res.location_name;
            const position = res.position;
            const eta = res.eta;
            const distance = res.distance_route;
            const nextStation = getNextStation(distance, locationName, eta);
            const destionationETA = moment()
                .add(eta[distance.length - 1], "minutes")
                .format("hh:mm");
            const destionationDistance = `${distance[distance.length - 1]} KM`;
            const nextDistance = `${nextStation.distance} KM`;
            $("#next").text(nextStation.name);
            $("#nextDistance").text(nextDistance);
            $("#nextEta").text(nextStation.eta);
            $("#from").text(res.location_name[0]);
            $("#position").text(position);
            $("#destination").text(destionation);
            $("#destinationDistance").text(destionationDistance);
            $("#destinationEta").text(destionationETA);

            $.map($(".input span"), function (v, i) {
                const travelTime = moment()
                    .add(eta[i], "minutes")
                    .format("hh:mm");
                $(v).attr("data-year", travelTime);
            });
            $("#route").empty();
            $.each(distance, (i, v) => {
                if (v == 0) {
                    $("#route").append(
                        `<div class="node sukses">
                        <h5>${locationName[i]}</h5>
                        <p class="text-muted">Sudah Terlewati</p>
                        </div>`
                    );
                } else {
                    $("#route").append(
                        `<div class="node warning">
                        <h5>${locationName[i]}</h5>
                        <p class="text-muted">Estimasi Tiba : ${moment()
                            .add(eta[i], "minutes")
                            .format("hh:mm")}</p>
                        </div>`
                    );
                }
            });
            if (res.text_info) {
                $("#infoText").text(res.text_info);
            }
        })
        .fail((err) => {
            console.log(err);
        });
}

function getNextStation(distance, location_name, eta) {
    let nextStation = {};

    for (let i = 0; i < distance.length; i++) {
        if (distance[i] != 0) {
            nextStation.name = location_name[i];
            nextStation.eta = moment().add(eta[i], "minutes").format("hh:mm");
            nextStation.distance = distance[i];
            break;
        }
    }
    return nextStation;
}
