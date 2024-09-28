@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Détails du Restaurant</h1>

    <p><strong>Nom:</strong> {{ $restaurant->nom }}</p>
    <p><strong>Adresse:</strong> {{ $restaurant->adresse }}</p>
    <p><strong>Site Web:</strong> <a href="{{ $restaurant->siteWeb }}" target="_blank">{{ $restaurant->siteWeb }}</a></p>
    <p><strong>Téléphone:</strong> {{ $restaurant->telephone }}</p>
    <p><strong>Description:</strong> {{ $restaurant->description }}</p>
    <p><strong>Note Moyenne:</strong> {{ $restaurant->noteMoyenne }}</p>

    @if($restaurant->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Image" width="100">
                </div>
            @else
                <p>Aucune image disponible</p>
            @endif

    <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Éditer</a>
    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
