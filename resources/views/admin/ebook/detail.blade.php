<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>-</title>

        <script src="{{ asset('js/jszip.js') }}"></script>
        <script src="{{ asset('js/epub.js') }}"></script>

        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('assets/app/css/read.css') }}"
        />
        <style type="text/css">
            body {
                display: flex;
                -webkit-align-items: center;
                -webkit-justify-content: center;
            }

            #viewer {
                width: 290px;
                height: 580px;
                box-shadow: 0 0 4px #ccc;
                padding: 10px 10px 0px 10px;
                margin: 5px auto;
                background: white;
            }

            @media only screen and (min-device-width: 320px) and (max-device-width: 667px) {
                #viewer {
                    height: 96.5%;
                }
                #viewer iframe {
                    /* pointer-events: none; */
                }
                .arrow {
                    position: inherit;
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div id="viewer"></div>
        <div id="prev" class="arrow">‹</div>
        <div id="next" class="arrow">›</div>
        <script>
            // Load the opf
            var book = ePub(
                "{{route('file-show-ebook',$detil_data->path_file)}}"
            );
            var rendition = book.renderTo("viewer", {
                manager: "continuous",
                flow: "paginated",
                width: "100%",
                height: "100%",
                snap: true,
            });

            var displayed = rendition.display();

            displayed.then(function (renderer) {
                // -- do stuff
            });

            // Navigation loaded
            book.loaded.navigation.then(function (toc) {
                // console.log(toc);
            });

            var next = document.getElementById("next");
            next.addEventListener(
                "click",
                function () {
                    rendition.next();
                },
                false
            );

            var prev = document.getElementById("prev");
            prev.addEventListener(
                "click",
                function () {
                    rendition.prev();
                },
                false
            );

            document.addEventListener(
                "keyup",
                function (e) {
                    // Left Key
                    if ((e.keyCode || e.which) == 37) {
                        rendition.prev();
                    }

                    // Right Key
                    if ((e.keyCode || e.which) == 39) {
                        rendition.next();
                    }
                },
                false
            );

            // $(window).on( "swipeleft", function( event ) {
            //   rendition.next();
            // });
            //
            // $(window).on( "swiperight", function( event ) {
            //   rendition.prev();
            // });
        </script>
    </body>
</html>
