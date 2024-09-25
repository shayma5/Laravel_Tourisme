@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Détails de la Campagne Promotionnelle</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $campagne->nom }}</h5>
            <p class="card-text"><strong>Budget:</strong> {{ $campagne->budget }}</p>
            <p class="card-text"><strong>Date de début:</strong> {{ $campagne->date_debut }}</p>
            <p class="card-text"><strong>Date de fin:</strong> {{ $campagne->date_fin }}</p>
        </div>
    </div>
    <a href="{{ route('campagnes.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
    <a href="{{ route('campagnes.edit', $campagne->id) }}" class="btn btn-warning mt-3">Modifier</a>
</div>
@endsection
