@extends('layouts.appuser')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-15 text-white mb-3 animated slideInDown">Foto</h1>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Projects Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
            </div>
            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12 text-center">
                </div>
            </div>
            <div class="row g-4 portfolio-container">
                @foreach ($fotos as $foto)
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded overflow-hidden">
                            <div class="overflow-hidden" style="height: 300px; overflow: hidden;">
                                <img class="img-fluid w-100" src="{{ url('gambar/foto/' . $foto->foto) }}" alt=""
                                    style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1"
                                        href="{{ url('gambar/foto/' . $foto->foto) }}" data-lightbox="raflesia"><i
                                            class="fa fa-eye"></i></a>

                                </div>
                            </div>
                            <div class="border border-5 border-light border-top-0 p-4">
                                <h5 class="lh-base mb-0 text-center">{{ $foto->nama }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Projects End -->
@endsection
