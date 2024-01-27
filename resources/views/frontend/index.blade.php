@extends('layouts.appuser')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative">
            @foreach ($headers as $header)
                <div class="owl-carousel-item position-relative">
                    <div class="image-container" style="height: 550px; overflow: hidden;">
                        <img class="img-fluid" src="{{ url('gambar/header/' . $header->foto) }}" alt=""
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8 text-center">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">{{ $header->judul }}
                                    </h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">{{ $header->deskripsi }}</h1>
                                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Carousel End -->

    <!-- Destinasi Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Destinasi</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($destinasis as $destinasi)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item">
                            <div class="overflow-hidden" style="height: 300px; overflow: hidden;">
                                <img class="img-fluid" src="{{ url('gambar/destinasi/' . $destinasi->foto) }}"
                                    alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="p-4 text-center border border-5 border-light border-top-0">
                                <h4 class="mb-3">{{ $destinasi->judul }}</h4>
                                <p>{{ Str::limit($destinasi->deskripsi, 50) }}</p>
                                <a class="fw-medium" href="{{ route('detail.destinasi', $destinasi->id) }}">Read More<i
                                        class="fa fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Destinasi End -->


    <!-- Event Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Event</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($events as $event)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="overflow-hidden" style="height: 200px; overflow: hidden;">
                                <img class="img-fluid" src="{{ url('gambar/event/' . $event->foto) }}" alt=""
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="text-center border border-5 border-light border-top-0 p-4">
                                <a href="{{ route('detail.event', $event->id) }}">
                                    <h5 class="mb-0">{{ $event->nama }}</h5>
                                    <small>{{ Str::limit($event->deskripsi, 40) }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Event End -->

    <!-- Galery Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Galery</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($fotos as $foto)
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ url('gambar/foto/' . $foto->foto) }}" alt=""
                                    style="width: 300px; height: 200px;"> <!-- Sesuaikan ukuran yang diinginkan -->
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1"
                                        href="{{ url('gambar/foto/' . $foto->foto) }}" data-lightbox="portfolio"><i
                                            class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="border border-5 border-light border-top-0 p-4">
                                <h5 class="lh-base mb-0 text-center">{{ $foto->nama }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Galery End -->
@endsection
