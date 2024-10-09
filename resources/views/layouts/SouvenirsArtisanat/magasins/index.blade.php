@extends('layouts.app')

@section('content')
<section class="store-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-4">
                <h2>Nos Magasins</h2>
                <p><strong>Découvrez nos différents magasins</strong> Explorez nos emplacements et trouvez les meilleures offres et produits locaux dans chaque magasin.</p>
            </div>

            <div class="clearfix"></div>

            @foreach($magasins as $magasin)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="store-thumb store-thumb-box">
                    <div class="store-image-box-wrap">
                        <a href="{{ route('layouts.SouvenirsArtisanat.magasins.index', $magasin->id) }}">
                            @if($magasin->image)
                                <img src="{{ asset('storage/' . $magasin->image) }}" class="store-image img-fluid" alt="{{ $magasin->nomMagasin }}">
                            @else
                                <img src="{{ asset('images/placeholder-store.jpg') }}" class="store-image img-fluid" alt="Image placeholder">
                            @endif
                        </a>

                        <div class="store-image-box-wrap-info d-flex align-items-center">
                            <p class="mb-0">
                                <span class="badge badge-level">{{ $magasin->type }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="store-body">
                        <h4 class="store-title">
                            <a href="{{ route('layouts.SouvenirsArtisanat.magasins.index', $magasin->id) }}" class="store-title-link">{{ $magasin->nomMagasin }}</a>
                        </h4>

                        <div class="store-description mb-3">
                            {{ Str::limit($magasin->description, 100) }}
                        </div>

                        <div class="d-flex align-items-center">
                            <p class="store-location">
                                <i class="custom-icon bi-geo-alt me-1"></i>
                                {{ $magasin->adresse }}
                            </p>
                        </div>

                        @if($magasin->promotions->isNotEmpty())
                        <div class="store-promotions mb-3">
                            <p class="mb-1"><strong>Promotions en cours :</strong></p>
                            <ul class="list-unstyled">
                                @foreach($magasin->promotions as $promotion)
                                <li><i class="bi bi-tag-fill me-2"></i>{{ $promotion->nom }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($magasin->souvenirs->isNotEmpty())
                        <div class="store-souvenirs mb-3">
                            <p class="mb-1"><strong>Nombre de souvenirs disponibles :</strong> {{ $magasin->souvenirs->count() }}</p>
                        </div>
                        @endif

                        <div class="d-flex align-items-center border-top pt-3">
                            <a href="{{ route('layouts.SouvenirsArtisanat.magasins.show', $magasin->id) }}" class="custom-btn btn ms-auto">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection