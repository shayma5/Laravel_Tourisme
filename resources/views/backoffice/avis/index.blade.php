@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Avis</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped"> <!-- Améliorer le style du tableau -->
        <thead>
            <tr>
                <th>Nom du Client</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Date de l'Avis</th>
                <th>Restaurant</th>
                <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($avis as $avisItem)
                <tr>
                    <td>{{ $avisItem->nomClient }}</td>
                    <td>{{ $avisItem->note }}</td>
                    <td>{{ $avisItem->commentaire }}</td>
                    <td>{{ $avisItem->dateAvis }}</td>
                    <td>{{ $avisItem->restaurant ? $avisItem->restaurant->nom : 'Inconnu' }}</td>
                    <td>
                        <form action="{{ route('avis.destroy', $avisItem->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('avis.create') }}" class="btn btn-primary">Ajouter un Avis</a>
</div>
@endsection
