@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Campagnes Promotionnelles</h1>
    <a href="{{ route('campagnes.create') }}" class="btn btn-primary mb-3">Créer une nouvelle campagne</a>
    
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>Nom</th>
                <th>Budget</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($campagnes as $campagne)
            <tr>
                <td>{{ $campagne->nom }}</td>
                <td>{{ $campagne->budget }}</td>
                <td>{{ $campagne->date_debut }}</td>
                <td>{{ $campagne->date_fin }}</td>
                <td>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <a href="{{ route('campagnes.show', $campagne->id) }}" class="selectgroup-button text-primary">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                        </label>
                        
                        <label class="selectgroup-item">
                            <a href="{{ route('campagnes.edit', $campagne->id) }}" class="selectgroup-button text-warning">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                        </label>
                        
                        <label class="selectgroup-item">
                            <form action="{{ route('campagnes.destroy', $campagne->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="selectgroup-button text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>
                            </form>
                        </label>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
