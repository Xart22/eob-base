<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Cache-control" content="no-cache" />
        <title>Document</title>
        <link
            rel="stylesheet"
            href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"
        />
        <style>
            .col {
                background-color: orange;
                margin: 10px;
                padding: 10px;
                font-size: 20px;
                font-weight: bold;
                color: white;
            }
            .border {
                border: 1px solid black;
                border-radius: 25px;
            }
            .centering {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="row justify-content-center">
            <div class="col border">
                <p>{{$setting->nomor_ka}}</p>
                <p>{{$setting->nama_ka}}</p>
                <p>{{$setting->relasi_ka}}</p>
            </div>
            <div class="col border">
                <p>{{$setting->nama_csot}}</p>
                <p>{{$setting->nipp}}</p>
                <p>{{$setting->no_hp}}</p>
            </div>
            <div class="col border">
                <p id="etaNext">{{$setting->nama_csot}}</p>
                <p id="etaLast">{{$setting->nipp}}</p>
            </div>
            <div class="col border centering">
                <p id="speed">Kecepatan : 100 Km/j</p>
            </div>
            <div class="col border centering">
                <p id="clock"></p>
            </div>
        </div>
    </body>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script>
        const url = "{{route('getlocation')}}";
        $(document).ready(function () {
            console.log($("#info").text());
            currentTime();
            updateLocation();
        });
        setInterval(function () {
            currentTime();
        }, 1000);
        setInterval(() => {
            updateLocation();
        }, 20000);
        function updateLocation() {
            $.get(url, (res) => {
                const destionation =
                    res.location_name[res.location_name.length - 1];
                const locationName = res.location_name;
                const position = res.position;
                const eta = res.eta;
                const distance = res.distance_route;
                const nextStation = getNextStation(distance, locationName, eta);
                const destionationETA = moment()
                    .add(eta[distance.length - 1], "minutes")
                    .format("HH:mm");
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
                        .format("HH:mm");
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
                $("#lokasi").text(res.position);
                $("#speed").text(res.speed + " KM/H");
                $("#destination").text(
                    `ETA Stasiun Akhir : ${destionationETA} ${destionation}`
                );
                $("#next").text(`Stasiun Selanjutnya : ${nextStation.name}`);

                const textInfo =
                    $("#text").val() +
                    `| Kecepatan : ${res.speed} Lokasi Saat ini : ${
                        res.position
                    } Station Selanjutnya : ${nextStation.name} ETA : ${
                        nextStation.eta
                    } Station Terakhir : ${destionation} ETA : ${destionationETA} | ${
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

        function currentTime() {
            $("#clock").text(moment().format("DD/MM/YYYY HH:mm:ss"));
        }
    </script>
</html>
