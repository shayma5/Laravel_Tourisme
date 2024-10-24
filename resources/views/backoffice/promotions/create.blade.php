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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('promotions.store') }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                @error('nom')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
                @error('date_debut')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
                @error('date_fin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="campagne_promotionnelle_id">Campagne Promotionnelle</label>
                <select name="campagne_promotionnelle_id" class="form-control" required>
                    <option value="">Sélectionnez une campagne</option>
                    @foreach($campagnes as $campagne)
                        <option value="{{ $campagne->id }}" {{ old('campagne_promotionnelle_id') == $campagne->id ? 'selected' : '' }}>
                            {{ $campagne->nom }} ({{ $campagne->date_debut }} - {{ $campagne->date_fin }})
                        </option>
                    @endforeach
                </select>
                @error('campagne_promotionnelle_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    @endif
</div>
@endsection
