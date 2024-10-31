@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Souvenirs</h1>
    <a href="{{ route('souvenirs.create') }}" class="btn btn-primary mb-3">Ajouter un nouveau souvenir</a>

    <hr/>

    <form action="{{ route('souvenirs.index') }}" method="GET" class="mb-4">
        <!-- Filtre Magasin -->
        <div class="form-group mb-3">
            <h5><i class="fas fa-store text-primary"></i> Filtre Magasin</h5>
            <div class="btn-group" role="group">
                <input type="radio" name="magasin_filter" value="all" class="btn-check" id="mag_all" {{ request('magasin_filter', 'all') == 'all' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="mag_all">Tous les souvenirs</label>

                <input type="radio" name="magasin_filter" value="assigned" class="btn-check" id="mag_assigned" {{ request('magasin_filter') == 'assigned' ? 'checked' : '' }}>
                <label class="btn btn-outline-success" for="mag_assigned">Avec magasin</label>

                <input type="radio" name="magasin_filter" value="unassigned" class="btn-check" id="mag_unassigned" {{ request('magasin_filter') == 'unassigned' ? 'checked' : '' }}>
                <label class="btn btn-outline-danger" for="mag_unassigned">Sans magasin</label>
            </div>
        </div>

        <!-- Filtre Stock -->
        <div class="form-group mb-3">
            <h5><i class="fas fa-box text-success"></i> Filtre Stock</h5>
            <div class="btn-group" role="group">
                <input type="radio" name="stock_filter" value="all" class="btn-check" id="stock_all" {{ request('stock_filter', 'all') == 'all' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="stock_all">Tout le stock</label>

                <input type="radio" name="stock_filter" value="low" class="btn-check" id="stock_low" {{ request('stock_filter') == 'low' ? 'checked' : '' }}>
                <label class="btn btn-outline-warning" for="stock_low">Stock ≤ 20</label>

                <input type="radio" name="stock_filter" value="high" class="btn-check" id="stock_high" {{ request('stock_filter') == 'high' ? 'checked' : '' }}>
                <label class="btn btn-outline-success" for="stock_high">Stock > 20</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-filter"></i> Appliquer les filtres
        </button>
    </form>

    <hr/>

    @if(request('magasin_filter') == 'assigned')
        @foreach($magasins as $magasin)
            <div class="card mb-4">
                <div class="card-header">
                    <h4>{{ $magasin->nomMagasin }} ({{ $magasin->souvenirs->count() }} Souvenirs)</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Promotion</th>
                                <th>Nombre restant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($magasin->souvenirs as $souvenir)
                            <tr>
                                <td>{{ $souvenir->nom }}</td>
                                <td>{{ $souvenir->prix }}</td>
                                <td>{{ $souvenir->promotion ?? 'Aucune' }}</td>
                                <td>{{ $souvenir->nbr_restant }}</td>
                                <td>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="selectgroup-button text-primary">
                                                <i class="fas fa-eye fa-lg"></i>
                                            </a>
                                        </label>
                                        
                                        <label class="selectgroup-item">
                                            <a href="{{ route('souvenirs.edit', $souvenir->id) }}" class="selectgroup-button text-warning">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </a>
                                        </label>
                                        
                                        <label class="selectgroup-item">
                                            <form action="{{ route('souvenirs.destroy', $souvenir->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="selectgroup-button text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce souvenir ?')">
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
                </div>
            </div>
        @endforeach
    @else
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Promotion</th>
                    <th>Nombre restant</th>
                    <th>Magasin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($souvenirs as $souvenir)
                <tr>
                    <td>{{ $souvenir->nom }}</td>
                    <td>{{ $souvenir->prix }}</td>
                    <td>{{ $souvenir->promotion ?? 'Aucune' }}</td>
                    <td>{{ $souvenir->nbr_restant }}</td>
                    <td>
                        @if($souvenir->magasin)
                            <a href="{{ route('magasins.show', $souvenir->magasin->id) }}">
                                {{ $souvenir->magasin->nomMagasin }}
                            </a>
                        @else
                            ➖
                        @endif
                    </td>
                    <td>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="selectgroup-button text-primary">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            </label>
                            
                            <label class="selectgroup-item">
                                <a href="{{ route('souvenirs.edit', $souvenir->id) }}" class="selectgroup-button text-warning">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                            </label>
                            
                            <label class="selectgroup-item">
                                <form action="{{ route('souvenirs.destroy', $souvenir->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="selectgroup-button text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce souvenir ?')">
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
    @endif

    <div class="d-flex justify-content-center mt-4">
        <nav style="display: flex; flex-direction: row; transform: scale(0.8); border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
            <ul style="display: flex; flex-direction: row; list-style: none; margin: 0; padding: 0; font-size: 14px;">
                @if(request('magasin_filter') == 'assigned')
                    {{ $magasins->appends(request()->query())->links() }}
                @else
                    {{ $souvenirs->appends(request()->query())->links() }}
                @endif
            </ul>
        </nav>
    </div>
</div>
@endsection
