@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des plats</h1>
    <a href="{{ route('plats.create') }}" class="btn btn-primary">Ajouter un plat</a>

    <!-- Search input -->
    <input type="text" id="search" class="form-control mt-3 mb-3" placeholder="Rechercher un plat..." >
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Table to display plats -->
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="platTableBody">
            @foreach($plats as $plat)
                <tr>
                    <td>{{ $plat->nomPlat }}</td>
                    <td>{{ $plat->type }}</td>
                    <td>{{ $plat->prix }}€</td>
                    <td>
                        @if($plat->imageUrl)
                            <img src="{{ asset('storage/' . $plat->imageUrl) }}" alt="Image" width="100">
                        @else
                            Pas d'image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('plats.edit', $plat->id) }}" class="btn btn-warning">Modifier</a>
                        <a href="{{ route('plats.show', $plat->id) }}" class="btn btn-info">Voir</a>
                        <form action="{{ route('plats.destroy', $plat->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
     <!-- Ajout de la pagination -->
     <div class="d-flex justify-content-center">
        {{ $plats->links('vendor.pagination.custom') }} <!-- Assurez-vous que le chemin est correct -->
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('keyup', function() {
        var search = this.value;

        fetch("{{ route('plats.index') }}?search=" + search, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('platTableBody').innerHTML = html;
        });
    });
</script>
@endsection
