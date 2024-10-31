@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Détails du Souvenir</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $souvenir->nom }}</h5>
            <p class="card-text"><strong>Prix:</strong> {{ $souvenir->prix }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $souvenir->description }}</p>
            <p class="card-text"><strong>Promotion:</strong> {{ $souvenir->promotion ?? 'Aucune' }}</p>
            <p class="card-text"><strong>Nombre restant:</strong> {{ $souvenir->nbr_restant }}</p>
            <p class="card-text"><strong>Magasin:</strong> {{ $souvenir->magasin->nomMagasin }}</p>
            @if($souvenir->image)
                
            <img src="{{ asset('storage/'.$souvenir->image) }}" alt="{{ $souvenir->nom }}" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>
    </div>
    <a href="{{ route('souvenirs.edit', $souvenir->id) }}" class="btn btn-warning mt-3">Modifier</a>
    <a href="{{ route('souvenirs.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
