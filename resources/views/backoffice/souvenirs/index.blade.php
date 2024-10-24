@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Souvenirs</h1>
    <a href="{{ route('souvenirs.create') }}" class="btn btn-primary mb-3">Ajouter un nouveau souvenir</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Promotion</th>
                <th>Nombre restant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($souvenirs as $souvenir)
            <tr>
                <td>{{ $souvenir->nom }}</td>
                <td>{{ $souvenir->prix }}</td>
                <td>{{ $souvenir->promotion ?? 'Aucune' }}</td>
                <td>{{ $souvenir->nbr_restant }}</td>
                <td>
                    <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('souvenirs.edit', $souvenir->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('souvenirs.destroy', $souvenir->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce souvenir ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
    <nav style="display: flex; flex-direction: row; transform: scale(0.8); border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
        <ul style="display: flex; flex-direction: row; list-style: none; margin: 0; padding: 0; font-size: 14px;">
            {{ $souvenirs->links() }}
        </ul>
    </nav>
</div>


</div>
@endsection
