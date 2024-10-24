@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier le Magasin</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('magasins.update', $magasin->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nomMagasin">Nom du Magasin</label>
            <input type="text" class="form-control" id="nomMagasin" name="nomMagasin" value="{{ old('nomMagasin', $magasin->nomMagasin) }}" required>
            @error('nomMagasin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $magasin->type) }}" required>
            @error('type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $magasin->adresse) }}" required>
            @error('adresse')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $magasin->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if($magasin->image)
                <img src="{{ asset('storage/' . $magasin->image) }}" alt="{{ $magasin->nomMagasin }}" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
