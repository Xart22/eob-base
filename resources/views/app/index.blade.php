@extends('app.layout') @section('header')
<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/flickity/flickity.min.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/app/css/timeline.css') }}" />

@endsection @section('content')
<!-- Carousel -->
<div class="carousel-ads mt-3">
    <div
        id="carouselExampleIndicators"
        class="carousel slide"
        data-bs-ride="carousel"
    >
        <div class="carousel-indicators">
            <button
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
            ></button>
            <button
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="1"
                aria-label="Slide 2"
            ></button>
            <button
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="2"
                aria-label="Slide 3"
            ></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img
                    src="{{ asset('assets/img/portal.jpg') }}"
                    class="d-block w-100 rounded"
                    alt="..."
                />
            </div>
            <div class="carousel-item">
                <img
                    src="{{ asset('assets/img/portal.jpg') }}"
                    class="d-block w-100 rounded"
                    alt="..."
                />
            </div>
            <div class="carousel-item">
                <img
                    src="{{ asset('assets/img/portal.jpg') }}"
                    class="d-block w-100 rounded"
                    alt="..."
                />
            </div>
        </div>
        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next"
        >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<div class="container mb-5">
    <div class="container mt-2">
        <div class="contianer-info">
            <h2>Info Perjalanan</h2>
            <div class="row row-cols-2">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="d-flex justify-content-around">
                            <div class="img-icon">
                                <img
                                    src="{{
                                        asset('assets/svg/train_station.svg')
                                    }}"
                                    width="50"
                                />
                            </div>
                            <div class="text-icon">
                                Station Asal
                                <p id="from"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="d-flex justify-content-around">
                            <div class="img-icon">
                                <img
                                    src="{{ asset('assets/svg/train.svg') }}"
                                    width="50"
                                />
                            </div>
                            <div class="text-icon">
                                Station Tujuan
                                <p id="destination"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-2">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="d-flex justify-content-around">
                            <div class="img-icon">
                                <img
                                    src="{{ asset('assets/svg/location.svg') }}"
                                    width="50"
                                />
                            </div>
                            <div class="text-icon">
                                Lokasi Saat Ini
                                <p id="position"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="d-flex justify-content-around">
                            <div class="img-icon">
                                <img
                                    src="{{
                                        asset('assets/svg/train_station.svg')
                                    }}"
                                    width="50"
                                />
                            </div>
                            <div class="text-icon">
                                Station Selanjutnya
                                <p id="next"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-2">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="d-flex justify-content-around">
                            <div class="img-icon">
                                <img
                                    src="{{ asset('assets/svg/cctv.svg') }}"
                                    width="50"
                                />
                            </div>
                            <div class="text-icon">
                                CCTV
                                <a href="{{ route('app-cctv') }}">
                                    <p class="mt-2">Lihat</p></a
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="d-flex justify-content-around">
                            <div class="img-icon">
                                <img
                                    src="{{ asset('assets/svg/distance.svg') }}"
                                    width="50"
                                />
                            </div>
                            <div class="text-icon">
                                Detail Perjalanan
                                <a
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                >
                                    <p class="mt-2">Lihat</p></a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PT.KAI -->
    <div class="container mt-2">
        <div class="container-news">
            <h2>Seputar PT.KAI</h2>
            <div class="gallery js-flickity">
                @if(!empty($data_company)) @foreach($data_company as $company)
                <a href="{{ route('app-company',$company->uuid) }}">
                    <div class="gallery-cell">
                        <div class="card">
                            <img
                                class="img-news"
                                src="{{ route('file-show-company', $company->news_img) }}"
                                alt=""
                            />
                            {{$company->news_title}}
                        </div>
                    </div>
                </a>
                @endforeach @endif
            </div>
        </div>
    </div>
    <!-- PT.KAI  -->

    <!-- News -->
    <div class="container mt-2">
        <div class="container-news">
            <h2>Berita Hari Ini</h2>
            <div class="gallery js-flickity">
                @if(!empty($data_news)) @foreach($data_news as $news)
                <a href="{{ route('app-news',$news->uuid) }}">
                    <div class="gallery-cell">
                        <div class="card">
                            <img
                                class="img-news"
                                src="{{ route('file-show-news', $news->news_img) }}"
                                alt=""
                            />
                            {{$news->news_headline}}
                        </div>
                    </div>
                </a>
                @endforeach @endif
            </div>
        </div>
    </div>
    <!-- News End -->
</div>

<!-- Modal Detail -->
<!-- Modal Detail -->
<div
    class="modal fade"
    id="exampleModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Detail Perjalanan
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="timeline-wrapper" id="route"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Detail -->

@endsection @section('script')
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flickity/flickity.min.js') }}"></script>
<script src="{{ asset('assets/app/js/location.js') }}"></script>
<script>
    $(".js-flickity").flickity({
        contain: true,
        prevNextButtons: false,
        pageDots: false,
    });
</script>

@endsection
