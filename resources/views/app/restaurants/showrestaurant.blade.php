@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $restaurant->nom }}</h1>
    <p><strong>Adresse :</strong> {{ $restaurant->adresse }}</p>
    <p><strong>Site Web :</strong> <a href="{{ $restaurant->siteweb }}" target="_blank">{{ $restaurant->siteweb }}</a></p>
    <p><strong>Téléphone :</strong> {{ $restaurant->telephone }}</p>
    <p><strong>Note Moyenne :</strong> {{ $restaurant->noteMoyenne }}</p>
    <p><strong>Description :</strong> {{ $restaurant->description }}</p>

    <h2>Plats Associés</h2>
@if($restaurant->plats->isEmpty())
    <p>Aucun plat associé à ce restaurant.</p>
@else
    <ul>
        @foreach($restaurant->plats as $plat)
            <li>
                <strong>{{ $plat->nomPlat }}</strong> - Prix: {{ $plat->prix }} €
                <!-- Affichage de l'image du plat -->
                @if($plat->imageUrl)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $plat->imageUrl) }}" alt="Image de {{ $plat->nomPlat }}" width="100">
                    </div>
                @else
                    <p>Aucune image disponible</p>
                @endif
            </li>
        @endforeach
    </ul>
@endif
</div>
@endsection
