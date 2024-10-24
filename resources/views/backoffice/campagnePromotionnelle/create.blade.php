@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Créer une nouvelle Campagne Promotionnelle</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campagnes.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="budget">Budget</label>
            <input type="number" class="form-control" id="budget" name="budget" step="0.01" value="{{ old('budget') }}" required>
            @error('budget')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required>
            @error('date_debut')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required>
            @error('date_fin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

<script>
    document.getElementById('date_debut').addEventListener('change', function() {
        var dateDebut = this.value;
        document.getElementById('date_fin').setAttribute('min', dateDebut);
    });
</script>

@endsection
