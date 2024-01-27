@extends('layouts.appuser')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-15 text-white mb-3 animated slideInDown">Video</h1>
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
                @foreach ($vidios as $vidio)
                    <div class="col-lg-6 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card">
                            <div class="position-relative overflow-hidden">
                                <!-- Ganti 'YOUTUBE_VIDEO_ID' dengan ID video YouTube yang sesuai -->
                                <iframe width="100%" height="300" src="{{ $vidio->link_youtube }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="card-body">
                                {{-- <p class="text-primary fw-medium mb-2">Judul Video</p> --}}
                                <h5 class="lh-base mb-0">{{ $vidio->judul }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Projects End -->
@endsection
