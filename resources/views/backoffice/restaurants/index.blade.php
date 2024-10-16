@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Restaurants</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('restaurants.create') }}" class="btn btn-primary">Ajouter un Restaurant</a>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('restaurants.index') }}" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" id="search" name="search" class="form-control" placeholder="Rechercher par nom" value="{{ request('search') }}">
        </div>
    </form>

    <!-- Table pour afficher la liste des restaurants -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Image</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="restaurant-list">
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->id }}</td>
                    <td>{{ $restaurant->nom }}</td>
                    <td>
                        @if($restaurant->image)
                            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Image" width="100">
                        @else
                            Pas d'image
                        @endif
                    </td>
                    <td>{{ $restaurant->adresse }}</td>
                    <td>
                        <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Éditer</a>
                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $restaurants->links('vendor.pagination.custom') }} <!-- Assurez-vous que le chemin est correct -->
    </div>
</div>

<!-- Script pour la recherche dynamique avec AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('restaurants.index') }}", // URL de la route
                type: "GET",
                data: {'search': query}, // Envoyer la requête de recherche
                success: function(data) {
                    $('#restaurant-list').html(data); // Mise à jour de la table avec les résultats
                }
            });
        });
    });
</script>
@endsection
