@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Créer un nouveau Magasin</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('magasins.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group">
            <label for="nomMagasin">Nom du Magasin</label>
            <input type="text" class="form-control" id="nomMagasin" name="nomMagasin" value="{{ old('nomMagasin') }}" required>
            @error('nomMagasin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
            @error('type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
            @error('adresse')
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
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <hr>
            <h4>Promotions</h4>
            <div class="card-body">
                @if($promotions->isNotEmpty())
                    <select class="form-control mb-3" name="promotions[]" multiple>
                        <option value="">Aucune promotion</option>
                        @foreach($promotions as $promotion)
                            @php
                                $daysRemaining = \Carbon\Carbon::parse($promotion->date_fin)->diffInDays(now());
                            @endphp
                            <option value="{{ $promotion->id }}">
                                {{ $promotion->nom }} 
                                ({{ $promotion->date_debut }} - {{ $promotion->date_fin }})
                                @if($daysRemaining <= 10)
                                    <span class="text-danger">({{ $daysRemaining }} jours restants)</span>
                                @else
                                    ({{ $daysRemaining }} jours restants)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('promotions.create') }}" class="btn btn-primary">Créer une nouvelle promotion</a>
                @else
                    <div class="alert alert-info">
                        <p>Aucune promotion n'est disponible actuellement. Vous pourrez en ajouter ultérieurement.</p>
                        <p>Pour créer une nouvelle promotion maintenant, cliquez sur le bouton ci-dessous.</p>
                    </div>
                    <a href="{{ route('promotions.create') }}" class="btn btn-primary">Créer une nouvelle promotion</a>
                @endif
            </div>
        </div>


        <hr>
        <br>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
