@extends('layouts.backoffice')

@section('content')
<div class="container ">
    <h1 class="mb-4">Détails du Restaurant</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $restaurant->nom }}</h5>
            <p class="card-text"><strong>Adresse:</strong> {{ $restaurant->adresse }}</p>
            <p class="card-text">
                <strong>Site Web:</strong> 
                <a href="{{ $restaurant->siteWeb }}" target="_blank" class="text-primary">{{ $restaurant->siteWeb }}</a>
            </p>
            <p class="card-text"><strong>Téléphone:</strong> {{ $restaurant->telephone }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $restaurant->description }}</p>
            <p class="card-text"><strong>Note Moyenne:</strong> {{ $restaurant->noteMoyenne }}</p>

            @if($restaurant->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Image" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                </div>
            @else
                <p>Aucune image disponible</p>
            @endif

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Éditer</a>
                <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection
