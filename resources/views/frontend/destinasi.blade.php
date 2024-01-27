@extends('layouts.appuser')
@section('content')
    <!-- Destinasi Start -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-15 text-white mb-3 animated slideInDown">Destination </h1>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Destinasi Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
            </div>
            <div class="row g-4">
                <div class="row g-4">
                    @foreach ($destinasis as $destinasi)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item">
                                <div class="overflow-hidden" style="height: 250px; overflow: hidden;">
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
    </div>
    <!-- Destinasi End -->
@endsection
