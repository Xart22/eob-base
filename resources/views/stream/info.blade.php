<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Cache-control" content="no-cache" />
        <title>Document</title>
    </head>
    <body style="width: 100%; height: fit-content">
        <marquee
            direction="left"
            width="100%"
            id="info"
            bgcolor="#000000"
            style="color: white; font-size: 50px; font-family: Impact"
        ></marquee>
    </body>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            console.log($("#info").text());
            updateLocation();
        });
        setInterval(() => {
            updateLocation();
        }, 60000);
        function updateLocation() {
            $.get("/public/app/nvr/location", (res) => {
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
                $.map($(".input span"), function (v, i) {
                    const travelTime = moment()
                        .add(eta[i], "minutes")
                        .format("hh:mm");
                    $(v).attr("data-year", travelTime);
                });

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
                const textInfo = `| Kecepatan : ${
                    res.speed
                } Lokasi Saat ini : ${res.position} Statiun Selanjutnya : ${
                    nextStation.name
                } ETA : ${
                    nextStation.eta
                } Statiun Terakhir : ${destionation} ETA : ${destionationETA} | ${
                    res.text_info ? res.text_info : ""
                } `;
                $("#info").text(textInfo);
            });
        }
        function getNextStation(distance, location_name, eta) {
            let nextStation = {};

            for (let i = 0; i < distance.length; i++) {
                if (distance[i] != 0) {
                    nextStation.name = location_name[i];
                    nextStation.eta = moment()
                        .add(eta[i], "minutes")
                        .format("hh:mm");
                    nextStation.distance = distance[i];
                    break;
                }
            }
            return nextStation;
        }
    </script>
</html>
