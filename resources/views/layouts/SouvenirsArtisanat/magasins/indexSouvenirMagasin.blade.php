@extends('layouts.app')

@section('content')

<section class="job-section recent-jobs-section section-padding">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-12 mb-4">
                <h2>{{ $magasin->nom }}</h2>
                <p><strong>{{ $magasin->adresse }}</strong></p>
            </div>

            <div class="clearfix"></div>

            @foreach($magasin->souvenirs as $souvenir)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="job-thumb job-thumb-box">
                    <div class="job-image-box-wrap">
                        <a href="{{ route('souvenirs.show', $souvenir->id) }}">
                            <img src="{{ asset('storage/souvenirs/' . $souvenir->image) }}" class="job-image img-fluid" alt="{{ $souvenir->nom }}">
                        </a>
                    </div>

                    <div class="job-body">
                        <h4 class="job-title">
                            <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="job-title-link">{{ $souvenir->nom }}</a>
                        </h4>

                        <div class="d-flex align-items-center">
                            <p class="job-location mb-0">
                                <i class="custom-icon bi-geo-alt me-1"></i>
                                {{ $magasin->adresse }}
                            </p>

                            <p class="job-date mb-0">
                                <i class="custom-icon bi-clock me-1"></i>
                                {{ $souvenir->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="d-flex align-items-center border-top pt-3">
                            <p class="job-price mb-0">
                                <i class="custom-icon bi-cash me-1"></i>
                                {{ $souvenir->prix }}€
                            </p>

                            <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="custom-btn btn ms-auto">Voir Détails</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div> 
    </div> 
</section>
@endsection
