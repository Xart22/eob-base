@extends('app.layout') @section('header') @endsection @section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <iframe
                src="https://eob-kai.sonajaya.com/play-cctv"
                frameborder="0"
                allowfullscreen
                height="500"
                width="100%"
            ></iframe>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <p id="speed"></p>
            </div>
            <div class="col"><p id="lokasi"></p></div>
        </div>
    </div>
</div>
<input
    type="hidden"
    id="interval"
    value="{{ $setting->interval_update_location }}"
/>
@endsection @section('script')
<script type="module">
            const url = '{{ route('getlocation') }}';
            const interval = $("#interval").val() * 1000;
        $(document).ready(function () {
            updateLocation();
        });
        setInterval(() => {
            updateLocation();
    }, interval);
    function updateLocation() {
        $.get(url)
            .done(function (res) {
                const destionation =
                    res.location_name[res.location_name.length - 1];
                const speed = res.speed <= 20 ? 0 : res.speed;
                const location = res.position;
                const eta = res.eta;
                $("#speed").text('Kecepatan : '+speed + " Km/j");
                $("#lokasi").text('Lokasi : '+location);
            })
            .fail(function (data) {
                console.log(data);
            });
    }
</script>

@endsection
