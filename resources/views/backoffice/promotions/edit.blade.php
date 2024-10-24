@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier la Promotion</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $promotion->nom) }}" required>
            @error('nom')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $promotion->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ old('date_debut', $promotion->date_debut) }}" required>
            @error('date_debut')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ old('date_fin', $promotion->date_fin) }}" required>
            @error('date_fin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="campagne_promotionnelle_id">Campagne Promotionnelle</label>
            <select class="form-control" id="campagne_promotionnelle_id" name="campagne_promotionnelle_id" required>
                <option value="">Sélectionnez une campagne</option>
                @foreach($campagnes as $campagne)
                    <option value="{{ $campagne->id }}" {{ old('campagne_promotionnelle_id', $promotion->campagne_promotionnelle_id) == $campagne->id ? 'selected' : '' }}>
                        {{ $campagne->nom }}
                    </option>
                @endforeach
            </select>
            @error('campagne_promotionnelle_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
