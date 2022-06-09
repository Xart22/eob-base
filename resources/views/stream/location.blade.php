<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <style>
            body {
                background-color: black !important;
            }
        </style>
    </head>
    <body style="width: fit-content">
        <div class="container">
            <div
                class="row"
                style="color: white; font-size: xx-large; font-family: Impact"
            >
                <div class="col" id="speed"><h3>Speed : 0</h3></div>
                <div class="col" id="location">
                    <h3>Location : -</h3>
                </div>
            </div>
        </div>
        <script src="{{
                asset('assets/plugins/jquery/jquery.min.js')
            }}"></script>
        <script src="{{
                asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')
            }}"></script>
        <script>
            $.get("/public/app/nvr/location", (res) => {
                $("#speed").text("Speed : " + res.speed + " Km/j");
                $("#location").text("Lokasi : " + res.positon);
            });
        </script>
    </body>
</html>
