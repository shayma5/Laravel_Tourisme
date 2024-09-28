@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-12">
            <div class="mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $restaurant->nom }}</h1>
                    <p><strong><i class="fas fa-map-marker-alt"></i> Adresse :</strong> {{ $restaurant->adresse }}</p>
                    <p><strong><i class="fas fa-globe"></i> Site Web :</strong> 
                        <a href="{{ $restaurant->siteweb }}" target="_blank" class="text-decoration-none">{{ $restaurant->siteweb }}</a>
                    </p>
                    <p><strong><i class="fas fa-phone"></i> Téléphone :</strong> {{ $restaurant->telephone }}</p>

                    <!-- Note Moyenne avec étoiles -->
                    <p><strong><i class="fas fa-star"></i> Note Moyenne :</strong> 
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $restaurant->noteMoyenne)
                                <i class="fas fa-star text-warning"></i> <!-- Étoile pleine -->
                            @else
                                <i class="far fa-star"></i> <!-- Étoile vide -->
                            @endif
                        @endfor
                        ({{ $restaurant->noteMoyenne }})
                    </p>
                    <p><strong><i class="fas fa-info-circle"></i> Description :</strong> {{ $restaurant->description }}</p>
                </div>
            </div>

            <h2 class="mb-4">Plats Associés</h2>

            @if($restaurant->plats->isEmpty())
                <p>Aucun plat associé à ce restaurant.</p>
            @else
                <div class="row">
                    @foreach($restaurant->plats as $plat)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-lg"> <!-- Arrondir la carte -->
                                <img src="{{ $plat->imageUrl ? asset('storage/' . $plat->imageUrl) : 'https://via.placeholder.com/150' }}" 
                                     alt="Image de {{ $plat->nomPlat }}" 
                                     class="card-img-top img-fluid rounded-top" 
                                     style="height: 300px; object-fit: cover;"> <!-- Arrondir image en haut -->
                                
                                <div class="card-body text-center">
                                    <h5 class="card-title font-weight-bold">{{ $plat->nomPlat }}</h5>
                                    <p class="card-text">
                                        <span class="badge badge-success">Prix: {{ $plat->prix }} €</span> <!-- Ajouter un badge pour le prix -->
                                    </p>

                                    <!-- Bouton pour des actions supplémentaires -->
                                    <!-- <a href="#" class="btn btn-primary btn-sm mt-2">Voir Détails</a> 
                                    <a href="#" class="btn btn-outline-success btn-sm mt-2">Ajouter au Panier</a> -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
