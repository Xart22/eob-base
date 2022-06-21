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
                                <div class="row">
                                    <div class="col">
                                        <p id="destination"></p>
                                    </div>
                                    <div class="col">
                                        <span
                                            class="text-muted eta"
                                            id="destinationEta"
                                        ></span>
                                    </div>
                                </div>
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
