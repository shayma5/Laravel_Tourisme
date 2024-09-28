@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un avis</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('avis.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="nomClient">Nom du client</label>
            <input type="text" name="nomClient" class="form-control" id="nomClient" required>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <select name="note" class="form-control" id="note" required>
                <option value="1">1 étoile</option>
                <option value="2">2 étoiles</option>
                <option value="3">3 étoiles</option>
                <option value="4">4 étoiles</option>
                <option value="5">5 étoiles</option>
            </select>
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" class="form-control" id="commentaire"></textarea>
        </div>

        <div class="form-group">
            <label for="restaurant_id">Restaurant</label>
            <select name="restaurant_id" class="form-control" id="restaurant_id" required>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->nom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Soumettre l'avis</button>
    </form>
</div>
@endsection
