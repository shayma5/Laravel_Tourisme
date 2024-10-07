@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Créer une nouvelle Promotion</h1>

    <!-- Vérification si des campagnes promotionnelles non expirées existent -->
    @if($campagnes->isEmpty())
        <!-- Si aucune campagne valide n'est disponible, afficher un message et un bouton pour créer une campagne -->
        <div class="alert alert-warning">
            <p>Aucune campagne promotionnelle valide n'est disponible.</p>
            <a href="{{ route('campagnes.create') }}" class="btn btn-primary">Créer une nouvelle campagne promotionnelle</a>
        </div>
    @else
        <!-- Si des campagnes existent, afficher le formulaire pour créer une promotion -->
        <form action="{{ route('promotions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" required>
            </div>
            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin" required>
            </div>
            <div class="form-group">
                <label for="campagne_promotionnelle_id">Campagne Promotionnelle</label>
                <select class="form-control" id="campagne_promotionnelle_id" name="campagne_promotionnelle_id" required>
                    @foreach($campagnes as $campagne)
                        <option value="{{ $campagne->id }}">{{ $campagne->nom }} ({{ $campagne->date_debut }} - {{ $campagne->date_fin }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    @endif
</div>
@endsection