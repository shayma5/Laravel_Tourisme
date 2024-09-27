@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Détails du plat : {{ $plat->nomPlats }}</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $plat->nomPlats }}</h2>
            <p class="card-text"><strong>Type :</strong> {{ $plat->type }}</p>
            <p class="card-text"><strong>Prix :</strong> {{ $plat->prix }} €</p>
            <p class="card-text"><strong>Description :</strong> {{ $plat->description }}</p>

            @if($plat->imageUrl)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $plat->imageUrl) }}" alt="Image" width="100">
                </div>
            @else
                <p>Aucune image disponible</p>
            @endif

            <!-- <a href="{{ route('plats.edit', $plat->id) }}" class="btn btn-warning">Modifier</a> -->

            <!-- <form action="{{ route('plats.destroy', $plat->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form> -->
        </div>
    </div>

    <a href="{{ route('plats.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>
@endsection
