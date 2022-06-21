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
