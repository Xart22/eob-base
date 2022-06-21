import { io } from "socket.io-client";
const socket = io("http://153.92.5.205/");
const url = $("#locationUrl").val();
socket.on("connect", () => {
    console.log(socket.connected); // true
});
var lat = 0;
var lng = 0;
var speed = 0;

socket.on("message", (msg) => {
    lat = msg.lat;
    lng = msg.lon;
    speed = msg.speed;
});

$(document).ready(function () {
    $(".js-flickity").flickity({
        freeScroll: true,
        contain: true,
        prevNextButtons: false,
        pageDots: false,
    });
    updateLocation();
});
// const player = new JSMpeg.Player("ws://localhost:9090", {
//     autoplay: true,
// });
setInterval(() => {
    socket.emit("message", "gps");
    updateLocation();
}, 1000);
function updateLocation() {
    $.post(url, {
        lat: lat,
        lng: lng,
        speed: speed,
    })
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
            const destionationDistance = `<br /><span
            class="text-muted eta"
            >${distance[distance.length - 1]} KM<br />
            ETA : ${destionationETA}</span
        >`;
            const nextETA = `<br /><span
            class="text-muted eta"
            >${nextStation.distance} KM<br />
            ETA : ${nextStation.eta}</span
        >`;
            $("#next").text(nextStation.name);
            $("#next").append(nextETA);
            $("#from").text(res.location_name[0]);
            $("#position").text(position);
            $("#destination").text(destionation);
            $("#destination").append(destionationDistance);

            $.map($(".input span"), function (v, i) {
                const travelTime = moment()
                    .add(eta[i], "minutes")
                    .format("hh:mm");
                $(v).attr("data-year", travelTime);
            });

            $.each(distance, (i, v) => {
                $("#route").empty();
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
