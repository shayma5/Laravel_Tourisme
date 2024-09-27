@extends('layouts.backoffice')

@section('content')
<div class="container">


    <h1>Liste des plats</h1>
    <a href="{{ route('plats.create') }}" class="btn btn-primary">Ajouter un plat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
        <tbody>
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
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
