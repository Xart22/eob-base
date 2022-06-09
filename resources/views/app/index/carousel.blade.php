<div
    id="carouselExampleControls"
    class="carousel slide"
    data-bs-ride="carousel"
>
    <div class="carousel-inner">
        @foreach($sliders as $index=>$slider) @if($index === 0 )

        <div class="carousel-item active">
            <a
                href="#"
                onclick="detailItem(this)"
                data-bs-toggle="modal"
                data-bs-target="#detailModal"
                data-title="{{$slider->title}}"
                data-img="{{ route('file-show-slider', $slider->img) }}"
                data-content="{{ $slider->content }}"
            >
                <img
                    src="{{route('file-show-slider',$slider->img)}}"
                    class="d-block w-100"
                    alt="{{$slider->title}}"
            /></a>
        </div>

        @else
        <div class="carousel-item">
            <img
                src="{{route('file-show-slider',$slider->img)}}"
                class="d-block w-100"
                alt="{{$slider->title}}"
            />
        </div>
        @endif @endforeach
    </div>
    <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleControls"
        data-bs-slide="prev"
    >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleControls"
        data-bs-slide="next"
    >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<script>
    function detailItem(e) {
        console.log(e);
        let title = $(e).data("title");
        let img = $(e).data("img");
        let content = $(e).data("content");
        $("#imgHeader").attr("src", "");
        $("#imgHeader").attr("src", img);
        $("#content").append("<h4>" + title + "</h4>");
        $("#content").append(content);
    }
</script>
