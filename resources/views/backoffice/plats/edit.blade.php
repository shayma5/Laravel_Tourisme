@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier le plat : {{ $plat->nomPlat }}</h1>

    <form action="{{ route('plats.update', $plat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Indicate that this is a PUT request for updating -->

        <div class="form-group">
            <label for="restaurant_id">Choisir un restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">Sélectionnez un restaurant</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}" {{ $restaurant->id == $plat->restaurant_id ? 'selected' : '' }}>
                        {{ $restaurant->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nomPlat">Nom du plat</label>
            <input type="text" name="nomPlat" class="form-control" value="{{ old('nomPlat', $plat->nomPlat) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $plat->type) }}" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix', $plat->prix) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $plat->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($plat->imageUrl)
                <div>
                    <img src="{{ asset('storage/' . $plat->imageUrl) }}" alt="{{ $plat->nomPlat }}" style="max-width: 200px; margin-top: 10px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    </div>
@endsection
