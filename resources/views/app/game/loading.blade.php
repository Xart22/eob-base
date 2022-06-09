<div class="container-game">
    <h2 class="text-center">Game List</h2>
    <div class="d-flex flex-wrap justify-content-start">
        @foreach($data as $game)
        <div
            class="mx-auto mb-2 border p-2"
            style="width: 100px; height: fit-content"
        >
            <img
                src="{{ route('file-show-game',$game->path_banner) }}"
                class="img-fluid mb-2"
                alt="{{$game->game_name}}"
            />

            <p style="font-size: 2vw; word-wrap: break-word">
                {{$game->game_name}}
            </p>
            <a href="{{$game->game_url}}">
                <button class="btn btn-success w-100">Play</button></a
            >
        </div>
        @endforeach
    </div>
</div>
