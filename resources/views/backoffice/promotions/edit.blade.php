@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier la Promotion</h1>
    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $promotion->nom }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $promotion->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $promotion->date_debut }}" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $promotion->date_fin }}" required>
        </div>
        <div class="form-group">
            <label for="campagne_promotionnelle_id">Campagne Promotionnelle</label>
            <select class="form-control" id="campagne_promotionnelle_id" name="campagne_promotionnelle_id" required>
                @foreach($campagnes as $campagne)
                    <option value="{{ $campagne->id }}" {{ $promotion->campagne_promotionnelle_id == $campagne->id ? 'selected' : '' }}>
                        {{ $campagne->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
