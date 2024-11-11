@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Détails de la Promotion</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $promotion->nom }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $promotion->description }}</p>
            <p class="card-text"><strong>Date de début:</strong> {{ $promotion->date_debut }}</p>
            <p class="card-text"><strong>Date de fin:</strong> {{ $promotion->date_fin }}</p>
            <p class="card-text"><strong>Campagne Promotionnelle:</strong> {{ $promotion->campagnePromotionnelle->nom }}</p>
        </div>
    </div>
    <a href="{{ route('promotions.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
    <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning mt-3">Modifier</a>
</div>
@endsection
