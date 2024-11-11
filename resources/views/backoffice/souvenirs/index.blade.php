@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Liste des Souvenirs</h1>
    <a href="{{ route('souvenirs.create') }}" class="btn btn-primary mb-3">Ajouter un nouveau souvenir</a>

    <hr/>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-1">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Filtres</h4>
                </div>
                <form action="{{ route('souvenirs.index') }}" method="GET" class="mb-4">
                    <!-- Filtre Magasin -->
                    <br>
                    <div class="d-flex flex-column align-items-center">
                        <h5><i class="fas fa-store text-primary"></i> Filtre Magasin</h5>
                        <div class="btn-group" role="group">
                            <input type="radio" name="magasin_filter" value="all" class="btn-check" id="mag_all" {{ request('magasin_filter', 'all') == 'all' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="mag_all">Tous les souvenirs</label>

                            <input type="radio" name="magasin_filter" value="assigned" class="btn-check" id="mag_assigned" {{ request('magasin_filter') == 'assigned' ? 'checked' : '' }}>
                            <label class="btn btn-outline-success" for="mag_assigned">Avec magasin</label>

                            <input type="radio" name="magasin_filter" value="unassigned" class="btn-check" id="mag_unassigned" {{ request('magasin_filter') == 'unassigned' ? 'checked' : '' }}>
                            <label class="btn btn-outline-danger" for="mag_unassigned">Sans magasin</label>
                        </div>
                        <br>
                    </div>

                    <!-- Filtre Stock -->
                    <div class="d-flex flex-column align-items-center">
                        <h5><i class="fas fa-box text-success"></i> Filtre Stock</h5>
                        <div class="btn-group" role="group">
                            <input type="radio" name="stock_filter" value="all" class="btn-check" id="stock_all" {{ request('stock_filter', 'all') == 'all' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="stock_all">Tout le stock</label>

                            <input type="radio" name="stock_filter" value="low" class="btn-check" id="stock_low" {{ request('stock_filter') == 'low' ? 'checked' : '' }}>
                            <label class="btn btn-outline-warning" for="stock_low">Stock ≤ 20</label>

                            <input type="radio" name="stock_filter" value="high" class="btn-check" id="stock_high" {{ request('stock_filter') == 'high' ? 'checked' : '' }}>
                            <label class="btn btn-outline-success" for="stock_high">Stock > 20</label>
                        </div>
                        <br>
                    </div>


                    <div class="d-flex flex-column align-items-center">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-filter"></i> Appliquer les filtres
                        </button>
                    </div>


                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Statistiques des Souvenirs</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd justify-content-center" id="stats-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="magasins-tab" data-bs-toggle="pill" href="#magasins-chart" role="tab">
                                <i class="fas fa-store"></i> Magasins
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stock-tab" data-bs-toggle="pill" href="#stock-chart" role="tab">
                                <i class="fas fa-box"></i> Stock
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="magasins-chart" role="tabpanel">
                            <div class="chart-container" style="height: 100px;">
                                <canvas id="magasinsPieChart"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="stock-chart" role="tabpanel">
                            <div class="chart-container" style="height: 100px;">
                                <canvas id="stockPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <hr/>

    @if(request('magasin_filter') == 'assigned')
        @foreach($magasins as $magasin)
            <div class="card mb-4 ">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const magasinsData = {
        labels: ['Avec magasins', 'Sans magasin'],
        datasets: [{
            data: [
                {{ \App\Models\Souvenir::has('magasin')->count() }},
                {{ \App\Models\Souvenir::doesntHave('magasin')->count() }}
            ],
            backgroundColor: ['#28a745', '#dc3545'],
            borderWidth: 0
        }]
    };

    const stockData = {
        labels: ['Stock suffisant', 'Stock faible'],
        datasets: [{
            data: [
                {{ \App\Models\Souvenir::where('nbr_restant', '>', 20)->count() }},
                {{ \App\Models\Souvenir::where('nbr_restant', '<=', 20)->count() }}
            ],
            backgroundColor: ['#28a745', '#dc3545'],
            borderWidth: 0
        }]
    };

    const noMagasinCount = {{ \App\Models\Souvenir::doesntHave('magasin')->count() }};
    const lowStockCount = {{ \App\Models\Souvenir::where('nbr_restant', '<=', 20)->count() }};

    if (noMagasinCount > 0) {
        document.querySelector('#magasins-chart').innerHTML += `
            <div class="mt-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Attention : il existe des souvenirs sans magasin, 
                    <a href="javascript:void(0)" class="alert-link" onclick="showSouvenirsWithoutMagasin()">cliquer ici</a> 
                    pour avoir plus de détails.
                </div>
            </div>
        `;
    }

    if (lowStockCount > 0) {
        document.querySelector('#stock-chart').innerHTML += `
            <div class="mt-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Attention : il existe des souvenirs en stock faible, 
                    <a href="javascript:void(0)" class="alert-link" onclick="showSouvenirsLowStock()">cliquer ici</a> 
                    pour avoir plus de détails.
                </div>
            </div>
        `;
    }

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    };

    new Chart(document.getElementById('magasinsPieChart'), {
        type: 'pie',
        data: magasinsData,
        options: chartOptions
    });

    new Chart(document.getElementById('stockPieChart'), {
        type: 'pie',
        data: stockData,
        options: chartOptions
    });
});

function showSouvenirsWithoutMagasin() {
    const souvenirs = {!! \App\Models\Souvenir::doesntHave('magasin')->get(['id', 'nom'])->toJson() !!};
    showSouvenirsModal('Sans magasin', souvenirs);
}

function showSouvenirsLowStock() {
    const souvenirs = {!! \App\Models\Souvenir::where('nbr_restant', '<=', 20)->get(['id', 'nom', 'nbr_restant'])->toJson() !!};
    showSouvenirsModal('Stock faible', souvenirs, true);
}

function showSouvenirsModal(title, souvenirs, showStock = false) {
    let content = `
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Les souvenirs ci-dessous sont ${title.toLowerCase()}. 
            ${title === 'Sans magasin' ? 
                'Cliquez sur le nom d\'un souvenir pour lui assigner un magasin.' : 
                'Cliquez sur le nom d\'un souvenir pour modifier son stock.'}
        </div>
        <ul class="list-group">
    `;
    
    souvenirs.forEach(souvenir => {
        const editUrl = `${window.location.protocol}//${window.location.host}/souvenirs/${souvenir.id}/edit${showStock ? '?scroll=stock' : '?scroll=magasin'}`;
        content += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="${editUrl}" class="text-primary" style="text-decoration: none;">
                    ${souvenir.nom}
                    <i class="fas fa-edit ms-2"></i>
                </a>
                ${showStock ? `<span class="badge bg-danger">${souvenir.nbr_restant} en stock</span>` : ''}
            </li>
        `;
    });
    content += '</ul>';

    Swal.fire({
        title: `Souvenirs ${title}`,
        html: content,
        width: 600,
        confirmButtonText: 'Fermer',
        confirmButtonColor: '#3085d6'
    });
}


</script>


@endsection
