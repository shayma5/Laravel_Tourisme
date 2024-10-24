@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Campagnes Promotionnelles</h1>
    <a href="{{ route('campagnes.create') }}" class="btn btn-primary mb-3">Créer une nouvelle campagne</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Budget</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campagnes as $campagne)
            <tr>
                <td>{{ $campagne->nom }}</td>
                <td>{{ $campagne->budget }}</td>
                <td>{{ $campagne->date_debut }}</td>
                <td>{{ $campagne->date_fin }}</td>
                <td>
                    <a href="{{ route('campagnes.show', $campagne->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('campagnes.edit', $campagne->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('campagnes.destroy', $campagne->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <div class="d-flex justify-content-center mt-4">
    <nav style="display: flex; flex-direction: row; transform: scale(0.8); border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
        <ul style="display: flex; flex-direction: row; list-style: none; margin: 0; padding: 0; font-size: 14px;">
            {{ $campagnes->links() }}
        </ul>
    </nav>
</div>


</div>


@endsection
