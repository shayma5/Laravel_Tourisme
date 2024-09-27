@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Ajouter un nouveau plat</h1>

    <form action="{{ route('plats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="restaurant_id">Choisir un restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">Sélectionnez un restaurant</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nomPlat">Nom du plat</label>
            <input type="text" name="nomPlat" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    </div>
@endsection
