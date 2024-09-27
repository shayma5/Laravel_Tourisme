@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Détails du Magasin</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $magasin->nomMagasin }}</h5>
            <p class="card-text"><strong>Type:</strong> {{ $magasin->type }}</p>
            <p class="card-text"><strong>Adresse:</strong> {{ $magasin->adresse }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $magasin->description }}</p>
            @if($magasin->image)
                <img src="{{ asset('storage/' . $magasin->image) }}" alt="{{ $magasin->nomMagasin }}" class="img-fluid">
            @endif
        </div>
    </div>
    <a href="{{ route('magasins.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
    <a href="{{ route('magasins.edit', $magasin->id) }}" class="btn btn-warning mt-3">Modifier</a>
</div>
@endsection
