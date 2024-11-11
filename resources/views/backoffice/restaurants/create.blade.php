@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Créer un Nouveau Restaurant</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
        @if($errors->has('nom'))
            <small class="text-danger">{{ $errors->first('nom') }}</small>
        @endif
    </div>

    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse') }}">
        @if($errors->has('adresse'))
            <small class="text-danger">{{ $errors->first('adresse') }}</small>
        @endif
    </div>

    <div class="form-group">
        <label for="siteWeb">Site Web</label>
        <input type="url" name="siteWeb" id="siteWeb" class="form-control" value="{{ old('siteWeb') }}">
        @if($errors->has('siteWeb'))
            <small class="text-danger">{{ $errors->first('siteWeb') }}</small>
        @endif
    </div>

    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
        @if($errors->has('telephone'))
            <small class="text-danger">{{ $errors->first('telephone') }}</small>
        @endif
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        @if($errors->has('description'))
            <small class="text-danger">{{ $errors->first('description') }}</small>
        @endif
    </div>

    <div class="form-group">
    <label for="noteMoyenne">Note Moyenne (1 à 5)</label>
    <input type="number" name="noteMoyenne" id="noteMoyenne" class="form-control" step="0.1" min="1" max="5" value="{{ old('noteMoyenne') }}" required>
    @if($errors->has('noteMoyenne'))
        <small class="text-danger">{{ $errors->first('noteMoyenne') }}</small>
    @endif
</div>

    <div class="form-group">
        <label for="image">Image</label>
        <input id="image" type="file" name="image" class="form-control">
        @if($errors->has('image'))
            <small class="text-danger">{{ $errors->first('image') }}</small>
        @endif
    </div>

    <button type="submit" class="btn btn-success">Créer</button>
    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Retour</a>
</form>

</div>
@endsection
