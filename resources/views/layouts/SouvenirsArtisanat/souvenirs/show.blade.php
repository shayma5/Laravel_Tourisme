@extends('layouts.app')

@section('content')
<section class="job-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                <h2>{{ $souvenir->nom }}</h2>
                <p><strong>Prix : {{ $souvenir->prix }}€</strong></p>
            </div>

            <div class="col-lg-12 col-12">
                <div class="job-thumb d-flex flex-column">
                    <div  class="job-image-box-wrap  mb-4 ">
                        <img src="{{ asset('storage/' . $souvenir->image) }}" class="souvenir-image img-fluid" alt="{{ $souvenir->nom }}">
                    </div>

                    <div class="job-body">
                        <h4 class="souvenir-title">{{ $souvenir->nom }}</h4>
                        <p class="souvenir-description">{{ $souvenir->description }}</p>

                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                            <p class="souvenir-price mb-0">
                                <i class="custom-icon bi-cash me-1"></i>
                                {{ $souvenir->prix }}€
                            </p>
                            <a href="#" class="custom-btn btn">Acheter maintenant</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
