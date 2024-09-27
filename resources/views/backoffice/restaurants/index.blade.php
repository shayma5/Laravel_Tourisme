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

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->id }}</td>
                    <td>{{ $restaurant->nom }}</td>
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
</div>
@endsection
