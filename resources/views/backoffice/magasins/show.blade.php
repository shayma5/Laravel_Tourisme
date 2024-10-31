@extends('layouts.backoffice')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="d-flex align-items-center">
                {{ $magasin->nomMagasin }}
                @if($magasin->promotions->isEmpty())
                    <i class="fas fa-times-circle text-danger ms-2" title="Aucune promotion associée"></i>
                @endif
                <i class="fas fa-gift {{ $magasin->souvenirs->count() == 0 ? 'text-danger' : 'text-success' }} ms-2" title="Souvenirs"></i>
                <span>({{ $magasin->souvenirs->count() }})</span>
            </h2>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($magasin->image)
                        <img src="{{ asset('storage/' . $magasin->image) }}" class="img-fluid rounded" style="max-height: 300px; width: 100%; object-fit: cover;">
                    @endif
                </div>
                <div class="col-md-6">
                    <h4>Informations générales</h4>
                    <p><strong>Type:</strong> {{ $magasin->type }}</p>
                    <p><strong>Adresse:</strong> {{ $magasin->adresse }}</p>
                    <p><strong>Description:</strong> {{ $magasin->description }}</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h4>Liste des Souvenirs</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($magasin->souvenirs->sortBy('nbr_restant') as $souvenir)
                            <tr>
                                <td>{{ $souvenir->nom }}</td>
                                <td>{{ $souvenir->prix }}€</td>
                                <td>
                                    @if($souvenir->nbr_restant <= 20)
                                        <span class="text-danger">
                                            {{ $souvenir->nbr_restant }}
                                            <i class="fas fa-exclamation-circle"></i>
                                        </span>
                                    @else
                                        {{ $souvenir->nbr_restant }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="btn btn-info btn-sm">Voir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h4>Promotions en cours</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($magasin->promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->nom }}</td>
                                <td>{{ $promotion->date_debut }}</td>
                                <td>{{ $promotion->date_fin }}</td>
                                <td>
                                    <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-info btn-sm">Voir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('magasins.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('magasins.edit', $magasin->id) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
