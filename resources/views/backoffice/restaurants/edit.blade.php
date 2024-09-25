@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Éditer le Restaurant</h1>

    <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $restaurant->nom }}" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $restaurant->adresse }}" required>
        </div>

        <div class="form-group">
            <label for="siteWeb">Site Web</label>
            <input type="url" name="siteWeb" id="siteWeb" class="form-control" value="{{ $restaurant->siteWeb }}">
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ $restaurant->telephone }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $restaurant->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="noteMoyenne">Note Moyenne</label>
            <input type="number" name="noteMoyenne" id="noteMoyenne" class="form-control" value="{{ $restaurant->noteMoyenne }}" step="0.1">
        </div>

        <button type="submit" class="btn btn-success">Mettre à Jour</button>
        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
