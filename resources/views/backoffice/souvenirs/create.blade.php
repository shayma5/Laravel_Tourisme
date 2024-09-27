@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Ajouter un nouveau Souvenir</h1>
    <form action="{{ route('souvenirs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="promotion">Promotion</label>
            <input type="number" step="0.01" class="form-control" id="promotion" name="promotion">
        </div>
        <div class="form-group">
            <label for="nbr_restant">Nombre restant</label>
            <input type="number" class="form-control" id="nbr_restant" name="nbr_restant" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="magasin_id">Magasin</label>
            <select class="form-control" id="magasin_id" name="magasin_id" required>
                @foreach($magasins as $magasin)
                    <option value="{{ $magasin->id }}">{{ $magasin->nomMagasin }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
