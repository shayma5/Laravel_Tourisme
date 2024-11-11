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
                        <h2>ROOMS</h2>
                        <p><strong>Lorem Ipsum dolor sit amet,</strong> consectetur adipsicing kengan omeg kohm tokito adipcingi elit eismuod larehai</p>
                    </div>

                    <div class="clearfix"></div>
                    @if ($maison->rooms->isNotEmpty())
                    @foreach ($maison->rooms as $room)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                @if ($room->image)
                                <img src="{{ asset('storage/' . $room->image) }}" alt="" class="job-image img-fluid" style="width: 300px; height: 200px; object-fit: cover;">
                                @else
                                No Image
                                @endif
                            </div>


                            <div class="job-body">
                                <h4 class="job-title">
                                    <a href="#" class="job-title-link">{{ $room->type }}</a>
                                </h4>

                                <div class="d-flex align-items-center">
                                    <a href="#" class="bi-bookmark ms-auto me-2"></a>
                                    <a href="#" class="bi-heart"></a>
                                </div>
                                <p class="job-location">
                                    {{ $room->description }}
                                </p>
                                <div class="d-flex align-items-center">
                                    <p class="job-location">
                                        <i class="custom-icon bi-door-open me-1"></i>
                                        Available: {{ $room->available ? 'Yes' : 'No' }}
                                    </p>
                                </div>

                                <div class="d-flex align-items-center border-top pt-3">
                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        {{ $room->price }} DT/night
                                    </p>

                                    <a href="{{ url('/booking/' . $room->id) }}" class="custom-btn btn ms-auto">reserver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h3>No rooms available for this Maison d'haute.</h3>
                    @endif
                </div>
            </div>
        </section>
    </main>
</body>
@endsection