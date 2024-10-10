@extends('layouts.app')

@section('content')

<body>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <main>
        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <div class="hero-section-text mt-5">
                            <h6 class="text-white">Is it possible to enjoy nature and preserve it?</h6>
                            <h1 class="hero-title text-white mt-4 mb-4">Absolutely! <br>We can make it happen</h1>
                            <a href="#categories-section" class="custom-btn custom-border-btn btn">Browse Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="job-section recent-jobs-section section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 mb-4">
                        <h2>Maison D'hote</h2>
                        <p><strong>Lorem Ipsum dolor sit amet,</strong> consectetur adipsicing kengan omeg kohm tokito adipcingi elit eismuod larehai</p>
                    </div>

                    <div class="clearfix"></div>

                    @foreach ($maisons as $maison)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                @if ($maison->image)
                                    <img src="{{ asset('storage/' . $maison->image) }}" alt="{{ $maison->name }}" class="job-image img-fluid">
                                @else
                                    No Image
                                @endif
                            </div>

                            <div class="job-body">
                                <h4 class="job-title">
                                    <a href="#" class="job-title-link">{{ $maison->name }}</a>
                                </h4>

                                <div class="d-flex align-items-center">
                                    <a href="#" class="bi-bookmark ms-auto me-2"></a>
                                    <a href="#" class="bi-heart"></a>
                                </div>

                                <div class="d-flex align-items-center">
                                    <p class="job-location">
                                        <i class="custom-icon bi-geo-alt me-1"></i>
                                        {{ $maison->location }}
                                    </p>
                                    <p class="job-location">
                                        <i class="custom-icon bi-door-open me-1"></i>
                                        {{ $maison->number_of_rooms }}
                                    </p>
                                </div>

                                <div class="d-flex align-items-center border-top pt-3">
                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        Start with 50 DT/night
                                    </p>

                                    <a href="{{ url('/maisondhote/' . $maison->id) }}" class="custom-btn btn ms-auto">See Rooms</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
    </main>
    @endsection