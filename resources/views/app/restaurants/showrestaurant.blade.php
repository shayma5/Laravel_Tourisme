@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-12">
            <div class="mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $restaurant->nom }}</h1>

                    @if($latitude && $longitude)
                        <p><strong><i class="fas fa-map-marker-alt"></i> Adresse :</strong>
                            <div id="mapContainer" style="height: 300px; width: 100%;"></div> <!-- Taille de la carte -->
                        </p>
                    @else
                        <p><strong><i class="fas fa-map-marker-alt"></i> Adresse :</strong> {{ $restaurant->adresse }}</p>
                        <p class="text-danger">L'adresse du restaurant est invalide ou introuvable.</p>
                    @endif

                    <p><strong><i class="fas fa-globe"></i> Site Web :</strong> 
                        <a href="{{ $restaurant->siteweb }}" target="_blank" class="text-decoration-none">{{ $restaurant->siteWeb }}</a>
                    </p>
                    <p><strong><i class="fas fa-phone"></i> Téléphone :</strong> {{ $restaurant->telephone }}</p>

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
                    <p id="distance" class="font-weight-bold"></p>
                </div>
            </div>

            <h2 class="mb-4">Plats Associés</h2>

            @if($restaurant->plats->isEmpty())
                <p>Aucun plat associé à ce restaurant.</p>
            @else
                <div class="row">
                    @foreach($restaurant->plats as $plat)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <img src="{{ $plat->imageUrl ? asset('storage/' . $plat->imageUrl) : 'https://via.placeholder.com/150' }}" 
                                     alt="Image de {{ $plat->nomPlat }}" 
                                     class="card-img-top img-fluid rounded-top" 
                                     style="height: 300px; object-fit: cover;">
                                
                                <div class="card-body text-center">
                                    <h5 class="card-title font-weight-bold">{{ $plat->nomPlat }}</h5>
                                    <p class="card-text">
                                        <span class="badge badge-success">Prix: {{ $plat->prix }} €</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@if($latitude && $longitude)
<!-- Script pour charger la carte HERE uniquement si les coordonnées sont disponibles -->
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

<script>
    // Fonction pour calculer la distance entre deux points
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Rayon de la Terre en kilomètres
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;

        const a = 
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Distance en kilomètres
    }

    // Initialisation de la plateforme HERE
    var platform = new H.service.Platform({
        'apikey': '9Qtd9yLpa2dk4F6pq-5WMbLF543ZhoEXd8kgDrpZ4S4'  // Remplace par ta clé API HERE
    });

    // Charger les couches de carte standard
    var defaultLayers = platform.createDefaultLayers();

    // Initialisation de la carte centrée sur les coordonnées du restaurant
    var map = new H.Map(
        document.getElementById('mapContainer'),
        defaultLayers.vector.normal.map,
        {
            zoom: 15,
            center: { lat: {{ $latitude }}, lng: {{ $longitude }} }
        }
    );

    // Activer les interactions de la carte (zoom, déplacement)
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

    // Ajouter un marker à la position du restaurant
    var restaurantMarker = new H.map.Marker({ lat: {{ $latitude }}, lng: {{ $longitude }} });
    map.addObject(restaurantMarker);

    // Vérifier si la géolocalisation est disponible
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLat = position.coords.latitude;
            var userLng = position.coords.longitude;

            // Ajouter un marker pour la position actuelle
            var userMarker = new H.map.Marker({ lat: userLat, lng: userLng });
            map.addObject(userMarker);

            // Centrer la carte sur la position actuelle
            map.setCenter({ lat: userLat, lng: userLng });
            console.log("Position actuelle:", userLat, userLng); // Affiche la position actuelle dans la console

            // Calculer la distance et l'afficher
            var distance = calculateDistance(userLat, userLng, {{ $latitude }}, {{ $longitude }});
            alert("La distance entre vous et le restaurant est de " + distance.toFixed(2) + " km.");
        }, function(error) {
            console.error('Erreur de géolocalisation : ', error);
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Permission de géolocalisation refusée.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Position non disponible.");
                    break;
                case error.TIMEOUT:
                    alert("La demande de géolocalisation a expiré.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Une erreur inconnue s'est produite.");
                    break;
            }
        });
    } else {
        console.error('La géolocalisation n\'est pas supportée par ce navigateur.');
    }
</script>


@endif
@endsection
