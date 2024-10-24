@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Promotions</h1>
    <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Créer une nouvelle promotion</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Campagne</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
            <tr>
                <td>{{ $promotion->nom }}</td>
                <td>{{ Str::limit($promotion->description, 50) }}</td>
                <td>{{ $promotion->date_debut }}</td>
                <td>{{ $promotion->date_fin }}</td>
                <td>{{ $promotion->campagnePromotionnelle->nom }}</td>
                <td>
                    <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
    <nav style="display: flex; flex-direction: row; transform: scale(0.8); border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
        <ul style="display: flex; flex-direction: row; list-style: none; margin: 0; padding: 0; font-size: 14px;">
            {{ $promotions->links() }}
        </ul>
    </nav>
</div>

</div>
@endsection
