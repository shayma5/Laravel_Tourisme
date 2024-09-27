@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Avis</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nom du Client</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Date de l'Avis</th>
                <th>Restaurant</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('avis.create') }}" class="btn btn-primary">Ajouter un Avis</a>
    </div>
@endsection
