@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Ajouter un nouveau Souvenir</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('souvenirs.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="{{ old('prix') }}" required>
            @error('prix')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="promotion">Promotion</label>
            <input type="number" step="0.1" class="form-control" id="promotion" name="promotion" value="0"">
            @error('promotion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nbr_restant">Nombre restant</label>
            <input type="number" class="form-control" id="nbr_restant" name="nbr_restant" value="{{ old('nbr_restant') }}" required>
            @error('nbr_restant')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="magasin_id">Magasin</label>
            <select class="form-control" id="magasin_id" name="magasin_id" >
                <option value="">➖ (aucun Magasin)</option>
                @foreach($magasins as $magasin)
                    <option value="{{ $magasin->id }}" >
                        {{ $magasin->nomMagasin }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
