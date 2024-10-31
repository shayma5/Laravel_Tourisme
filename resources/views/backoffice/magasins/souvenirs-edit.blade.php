@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Gérer les souvenirs de {{ $magasin->nomMagasin }}</h1>

    @if($availableSouvenirs->isEmpty() && $magasin->souvenirs->isEmpty())
        <div class="alert alert-info">
            Aucun souvenir n'est disponible
        </div>
        <a href="{{ route('souvenirs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un Souvenir
        </a>
    @else
        <form action="{{ route('magasins.souvenirs.update', $magasin->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sélectionner</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($availableSouvenirs as $souvenir)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="souvenirs[]" value="{{ $souvenir->id }}"
                                               {{ $magasin->souvenirs->contains($souvenir->id) ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $souvenir->nom }}</td>
                                    <td>{{ $souvenir->prix }}€</td>
                                    <td>{{ $souvenir->nbr_restant }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                    <a href="{{ route('magasins.edit', $magasin->id) }}" class="btn btn-secondary">Retour</a>
                    <a href="{{ route('souvenirs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter un Souvenir
                    </a>
                </div>
            </div>
        </form>
    @endif
</div>
@endsection
