@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un Nouveau Restaurant</h1>

    <form action="{{ route('restaurants.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="siteWeb">Site Web</label>
            <input type="url" name="siteWeb" id="siteWeb" class="form-control">
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="noteMoyenne">Note Moyenne</label>
            <input type="number" name="noteMoyenne" id="noteMoyenne" class="form-control" step="0.1">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
