@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Magasins</h1>
    <a href="{{ route('magasins.create') }}" class="btn btn-primary mb-3">Créer un nouveau magasin</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($magasins as $magasin)
            <tr>
                <td>{{ $magasin->nomMagasin }}</td>
                <td>{{ $magasin->type }}</td>
                <td>{{ $magasin->adresse }}</td>
                <td>
                    <a href="{{ route('magasins.show', $magasin->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('magasins.edit', $magasin->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('magasins.destroy', $magasin->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
