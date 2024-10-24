@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier la Campagne Promotionnelle</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campagnes.update', $campagne->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $campagne->nom) }}" required>
            @error('nom')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="budget">Budget</label>
            <input type="number" class="form-control" id="budget" name="budget" step="0.01" value="{{ old('budget', $campagne->budget) }}" required>
            @error('budget')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ old('date_debut', $campagne->date_debut) }}" required>
            @error('date_debut')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ old('date_fin', $campagne->date_fin) }}" required>
            @error('date_fin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
