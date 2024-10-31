@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Promotions</h1>
    <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Créer une nouvelle promotion</a>
    
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Campagne</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($promotions as $promotion)
            <tr>
                <td>{{ $promotion->nom }}</td>
                <td>{{ Str::limit($promotion->description, 50) }}</td>
                <td>{{ $promotion->date_debut }}</td>
                <td>{{ $promotion->date_fin }}</td>
                <td>{{ $promotion->campagnePromotionnelle->nom }}</td>
                <td>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <a href="{{ route('promotions.show', $promotion->id) }}" class="selectgroup-button text-primary">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                        </label>
                        
                        <label class="selectgroup-item">
                            <a href="{{ route('promotions.edit', $promotion->id) }}" class="selectgroup-button text-warning">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                        </label>
                        
                        <label class="selectgroup-item">
                            <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="selectgroup-button text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion ?')">
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

    <div class="d-flex justify-content-center mt-4">
    <nav style="display: flex; flex-direction: row; transform: scale(0.8); border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
        <ul style="display: flex; flex-direction: row; list-style: none; margin: 0; padding: 0; font-size: 14px;">
            {{ $promotions->links() }}
        </ul>
    </nav>
</div>

</div>
@endsection
