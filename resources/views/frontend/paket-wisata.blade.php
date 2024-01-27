@extends('layouts.appuser')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-15 text-white mb-3 animated slideInDown">Paket Wisata</h1>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-start">

            </div>
            <div class="row g-4">
                @foreach ($pakets as $paket)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item">
                            <div class="p-4 text-center border border-5 border-light border-top-0">
                                <h4 class="mb-3">{{ number_format($paket->harga, 0, ',', '.') }}
                                    K</h4>
                                <p>{{ $paket->nama }}</p>
                                <div class="overflow-hidden">
                                    <div class="overflow-hidden" style="height: 200px; overflow: hidden;">
                                        <img class="img-fluid" src="{{ url('gambar/paket-wisata/' . $paket->foto) }}"
                                            alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <a class="fw-medium" href="{{ route('detail.paket', $paket->id) }}">Read More <i
                                            class="fa fa-arrow-right ms-2 mt-3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
