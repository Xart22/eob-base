<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/app/css/movie.css') }}" />
<div class="search-bar-container mt-5">
    <form action="">
        <input type="search" placeholder="Search Movie" data-search />
        <i class="fa fa-search"></i>
    </form>
</div>

<div class="d-flex flex-wrap mt-2">
    @foreach($data as $movie)
    <div
        class="col-md-3 p-1 bd-highlight mb-3"
        data-filter-item
        data-filter-name="{{strtolower($movie->movie_name)}}"
    >
        <div class="card">
            <a href="{{route('app-play-movie',$movie->uuid)}}">
                <div class="card-body">
                    <img
                        src="{{route('file-show-movie',$movie->path_banner)}}"
                        width="70"
                        height="110"
                    />
                    <div class="stars">
                        {{$movie->movie_rating

                        }}
                        <i class="fas fa-star" style="color: yellow"></i>
                    </div></div
            ></a>
        </div>
    </div>
    @endforeach
</div>

<div class="head-text text-center mt-2">
    <h2>Chanel TV</h2>
</div>
<div class="d-flex flex-wrap mt-2">
    @foreach($tv as $ch)
    <div
        class="col-md-3 p-1 bd-highlight mb-3"
        data-filter-item
        data-filter-name="{{strtolower($ch->ch_name)}}"
    >
        <div class="card">
            <a href="{{route('app-play-tv',$ch->uuid)}}">
                <div class="card-body">
                    <img
                        src="{{route('file-show-tv',$ch->path_banner)}}"
                        width="70"
                        height="110"
                    /></div
            ></a>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function () {
        $("[data-search]").on("keyup", function () {
            var searchVal = $(this).val();
            var filterItems = $("[data-filter-item]");
            var head = $(".head-text");
            if (searchVal != "") {
                filterItems.hide();
                head.hide();
                $(
                    '[data-filter-item][data-filter-name*="' +
                        searchVal.toLowerCase() +
                        '"]'
                ).show();
            } else {
                head.show();
                filterItems.show();
            }
        });
    });
</script>
