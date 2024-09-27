@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier le Souvenir</h1>
    <form action="{{ route('souvenirs.update', $souvenir->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $souvenir->nom }}" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="{{ $souvenir->prix }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $souvenir->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="promotion">Promotion</label>
            <input type="number" step="0.01" class="form-control" id="promotion" name="promotion" value="{{ $souvenir->promotion }}">
        </div>
        <div class="form-group">
            <label for="nbr_restant">Nombre restant</label>
            <input type="number" class="form-control" id="nbr_restant" name="nbr_restant" value="{{ $souvenir->nbr_restant }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if($souvenir->image)
                <img src="{{ asset('storage/'.$souvenir->image) }}" alt="{{ $souvenir->nom }}" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>
        <div class="form-group">
            <label for="magasin_id">Magasin</label>
            <select class="form-control" id="magasin_id" name="magasin_id" required>
                @foreach($magasins as $magasin)
                    <option value="{{ $magasin->id }}" {{ $souvenir->magasin_id == $magasin->id ? 'selected' : '' }}>
                        {{ $magasin->nomMagasin }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
