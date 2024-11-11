@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Ajouter un nouveau plat</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plats.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="form-group">
            <label for="restaurant_id">Choisir un restaurant</label>
            <select name="restaurant_id" class="form-control" required>
                <option value="">Sélectionnez un restaurant</option>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                        {{ $restaurant->nom }}
                    </option>
                @endforeach
            </select>
            @error('restaurant_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="nomPlat">Nom du plat</label>
            <input type="text" name="nomPlat" class="form-control" value="{{ old('nomPlat') }}" required>
            @error('nomPlat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
            @error('type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix') }}" required>
            @error('prix')
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
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
