@extends('layouts.backoffice')
@section('content')
<div class="container">
   <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Liste des Magasins</h1>
            <a href="{{ route('magasins.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un magasin
            </a>
        </div>


      <div class="btn-group" role="group" aria-label="Toggle view">
         <input type="radio" class="btn-check" name="view-type" id="list-view" value="list" checked>
         <label class="btn btn-outline-primary" for="list-view">
         <i class="fas fa-list"></i>
         </label>
         <input type="radio" class="btn-check" name="view-type" id="grid-view" value="grid">
         <label class="btn btn-outline-primary" for="grid-view">
         <i class="fas fa-th-large"></i>
         </label>
      </div>
   </div>

    <hr/>

    <div class="row mb-4">
        <div class="col-md-5 offset-md-1">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Filtres</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('magasins.index') }}" method="GET" class="mb-4">
                        <!-- Filtre Promotions -->
                        <div class="d-flex flex-column align-items-center">
                            <h5><i class="fas fa-times-circle text-danger"></i> Filtre Promotions</h5>
                            <div class="btn-group" role="group">
                                <input type="radio" name="promotion_filter" value="all" class="btn-check" id="promo_all" {{ request('promotion_filter', 'all') == 'all' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="promo_all">Tous les magasins</label>
                                <input type="radio" name="promotion_filter" value="with_promo" class="btn-check" id="promo_with" {{ request('promotion_filter') == 'with_promo' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="promo_with">Avec promotion</label>

                                <input type="radio" name="promotion_filter" value="no_promo" class="btn-check" id="promo_none" {{ request('promotion_filter') == 'no_promo' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="promo_none">Sans promotion</label>
                            </div>
                            <br>
                        </div>
                        <!-- Filtre Souvenirs -->
                        <div class="d-flex flex-column align-items-center">
                            <h5><i class="fas fa-gift text-success"></i> Filtre Souvenirs</h5>
                            <div class="btn-group" role="group">
                                <input type="radio" name="souvenir_filter" value="all" class="btn-check" id="souv_all" {{ request('souvenir_filter', 'all') == 'all' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="souv_all">Tous</label>
                                <input type="radio" name="souvenir_filter" value="0" class="btn-check" id="souv_0" {{ request('souvenir_filter') == '0' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="souv_0">0 <i class="fas fa-gift"></i></label>
                                <input type="radio" name="souvenir_filter" value="1-5" class="btn-check" id="souv_1_5" {{ request('souvenir_filter') == '1-5' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="souv_1_5">1-5 <i class="fas fa-gift"></i></label>
                                <input type="radio" name="souvenir_filter" value="6-10" class="btn-check" id="souv_6_10" {{ request('souvenir_filter') == '6-10' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="souv_6_10">6-10 <i class="fas fa-gift"></i></label>
                                <input type="radio" name="souvenir_filter" value="10+" class="btn-check" id="souv_10plus" {{ request('souvenir_filter') == '10+' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="souv_10plus">10+ <i class="fas fa-gift"></i></label>
                            </div>
                            <br>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <h5><i class="fas fa-list"></i> Nombre de magasins par page</h5>
                            <div class="btn-group" role="group">
                                <input type="radio" name="per_page" value="5" class="btn-check" id="per_page_5" {{ request('per_page', '10') == '5' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="per_page_5">5</label>
                                <input type="radio" name="per_page" value="10" class="btn-check" id="per_page_10" {{ request('per_page', '10') == '10' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="per_page_10">10</label>
                                <input type="radio" name="per_page" value="15" class="btn-check" id="per_page_15" {{ request('per_page', '10') == '15' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="per_page_15">15</label>
                            </div>
                            <br>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <button type="submit" class="btn btn-warning ">
                                <i class="fas fa-filter"></i> Appliquer les filtres
                            </button>
                        </div>

                        

                    </form>

                </div>
                
            </div>


        </div>
        <!-- New pie charts section -->
        <div class="col-md-4 offset-md-1">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Statistiques des Magasins</h4>
                </div>
                <div class="card-body">
                <ul class="nav nav-pills nav-secondary justify-content-center" id="stats-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="promotions-tab" data-bs-toggle="pill" href="#promotions-chart" role="tab">
                                <i class="fas fa-percentage"></i> Promotions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="souvenirs-tab" data-bs-toggle="pill" href="#souvenirs-chart" role="tab">
                                <i class="fas fa-gift"></i> Souvenirs
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="promotions-chart" role="tabpanel">
                            <div class="chart-container" style="height: 100px;">
                                <canvas id="promosPieChart"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="souvenirs-chart" role="tabpanel">
                            <div class="chart-container" style="height: 100px;">
                                <canvas id="souvenirsPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
   
   <hr/>
   
   
   
   <!-- Vue Liste -->
   <div id="list-view-content" class="mx-3">
        @foreach($magasins as $magasin)
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 style="display: inline-flex; align-items: center; margin: 0;">
                            {{ $magasin->nomMagasin }}
                            <!-- Icône pour les promotions -->
                            @if($magasin->promotions->isEmpty())
                            <i class="fas fa-times-circle text-danger ms-2" title="Aucune promotion associée"></i>
                            @endif
                            <!-- Icône pour les souvenirs -->
                            <i class="fas fa-gift {{ $magasin->souvenirs->count() == 0 ? 'text-danger' : 'text-success' }} ms-2" title="Souvenirs"></i>
                            <span>({{ $magasin->souvenirs->count() }})</span>
                        </h2>
                    </div>
                    <div>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <a href="{{ route('magasins.show', $magasin->id) }}" class="selectgroup-button text-primary">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            </label>
                            
                            <label class="selectgroup-item">
                                <a href="{{ route('magasins.edit', $magasin->id) }}" class="selectgroup-button text-warning">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                            </label>
                            
                            <label class="selectgroup-item">
                                <form action="{{ route('magasins.destroy', $magasin->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="selectgroup-button text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin ?')">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                    <div class="col-md-6">
                        @if($magasin->image)
                        <img src="{{ asset('storage/' . $magasin->image) }}" class="img-fluid" style="width: 300px; height: 200px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4>Informations</h4>
                        <p><strong>Type:</strong> {{ $magasin->type }}</p>
                        <p><strong>Adresse:</strong> {{ $magasin->adresse }}</p>
                        <p><strong>Description:</strong> {{ $magasin->description }}</p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12 mb-4">
                        <h4>Liste des Souvenirs</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($magasin->souvenirs as $souvenir)
                                <tr>
                                <td><a href="{{ route('souvenirs.show', $souvenir->id) }}">{{ $souvenir->nom }}</a></td>
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <h4>Promotion Associée</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Nom</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($magasin->promotions as $promotion)
                                <tr>
                                <td><a href="{{ route('promotions.show', $promotion->id) }}">{{ $promotion->nom }}</a></td>
                                <td>{{ $promotion->date_debut }}</td>
                                <td>{{ $promotion->date_fin }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
   </div>

    <!-- Vue Grille -->
    <div id="grid-view-content" class="row ms-3" style="display: none;">
        <div class="row">
            @foreach($magasins as $magasin)
                <div class="col-md-4 mb-4">
                    <div class="card card-post card-round">
                        @if($magasin->image)
                        <img src="{{ asset('storage/' . $magasin->image) }}" 
                            class="card-img-top"
                            style="height: 200px; object-fit: cover;"
                            alt="{{ $magasin->nomMagasin }}">
                        @endif
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                            <div class="info-post ms-3">
                                <h4 class="mb-0">
                                    {{ $magasin->nomMagasin }}
                                    <!-- Icône pour les promotions -->
                                    @if($magasin->promotions->isEmpty())
                                        <i class="fas fa-times-circle text-danger ms-2" title="Aucune promotion associée"></i>
                                    @endif
                                    <!-- Icône pour les souvenirs -->
                                    <i class="fas fa-gift {{ $magasin->souvenirs->count() == 0 ? 'text-danger' : 'text-success' }} ms-2" title="Souvenirs"></i>
                                    <span>({{ $magasin->souvenirs->count() }})</span>
                                </h4>

                                <p class="text-muted mb-0">{{ $magasin->type }}</p>
                            </div>
                            </div>
                            <div class="separator-solid"></div>
                            <p class="card-text mb-2">
                            <i class="fas fa-map-marker-alt text-primary"></i> {{ $magasin->adresse }}
                            </p>
                            <p class="card-text">
                            {{ Str::limit($magasin->description, 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="btn-group" style="gap: 5px;">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <a href="{{ route('magasins.show', $magasin->id) }}" class="selectgroup-button text-primary">
                                                <i class="fas fa-eye fa-lg"></i>
                                            </a>
                                        </label>
                                        
                                        <label class="selectgroup-item">
                                            <a href="{{ route('magasins.edit', $magasin->id) }}" class="selectgroup-button text-warning">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </a>
                                        </label>
                                        
                                        <label class="selectgroup-item">
                                            <form action="{{ route('magasins.destroy', $magasin->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="selectgroup-button text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin ?')">
                                                    <i class="fas fa-trash fa-lg"></i>
                                                </button>
                                            </form>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


   <!-- Pagination Dynamique -->
   <div class="d-flex justify-content-center mt-4">
      <nav style="display: flex; flex-direction: row; transform: scale(0.8); border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
         <ul style="display: flex; flex-direction: row; list-style: none; margin: 0; padding: 0; font-size: 14px;">
            {{ $magasins->appends(request()->query())->links() }}
         </ul>
      </nav>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    const listView = document.getElementById('list-view');
    const gridView = document.getElementById('grid-view');
    const listViewContent = document.getElementById('list-view-content');
    const gridViewContent = document.getElementById('grid-view-content');

    // Restaurer la vue précédente
    const currentView = localStorage.getItem('viewType') || 'list';
    if (currentView === 'grid') {
        gridView.checked = true;
        listViewContent.style.display = 'none';
        gridViewContent.style.display = 'block';
    } else {
        listView.checked = true;
        listViewContent.style.display = 'block';
        gridViewContent.style.display = 'none';
    }

    listView.addEventListener('change', function() {
        localStorage.setItem('viewType', 'list');
        listViewContent.style.display = 'block';
        gridViewContent.style.display = 'none';
    });

    gridView.addEventListener('change', function() {
        localStorage.setItem('viewType', 'grid');
        listViewContent.style.display = 'none';
        gridViewContent.style.display = 'block';
        });
    });

</script>

<!-- Add this script section just before your existing scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const promosData = {
        labels: ['Avec promotions', 'Sans promotion'],
        datasets: [{
            data: [
                {{ \App\Models\Magasin::has('promotions')->count() }},
                {{ \App\Models\Magasin::doesntHave('promotions')->count() }}
            ],
            backgroundColor: ['#28a745', '#dc3545'],
            borderWidth: 0
        }]
    };

    const souvenirsData = {
        labels: ['Avec souvenirs', 'Sans souvenir'],
        datasets: [{
            data: [
                {{ \App\Models\Magasin::has('souvenirs')->count() }},
                {{ \App\Models\Magasin::doesntHave('souvenirs')->count() }}
            ],
            backgroundColor: ['#28a745', '#dc3545'],
            borderWidth: 0
        }]
    };

    const noPromotionsCount = {{ \App\Models\Magasin::doesntHave('promotions')->count() }};
    const noSouvenirsCount = {{ \App\Models\Magasin::doesntHave('souvenirs')->count() }};

    if (noPromotionsCount > 0) {
        document.querySelector('#promotions-chart').innerHTML += `
            <div class="mt-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Attention : il existe des magasins sans promotion, 
                    <a href="javascript:void(0)" class="alert-link" onclick="showMagasinsWithoutPromotions()">cliquer ici</a> 
                    pour avoir plus de détails.
                </div>
            </div>
        `;
    }

    if (noSouvenirsCount > 0) {
        document.querySelector('#souvenirs-chart').innerHTML += `
            <div class="mt-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Attention : il existe des magasins sans souvenirs, 
                    <a href="javascript:void(0)" class="alert-link" onclick="showMagasinsWithoutSouvenirs()">cliquer ici</a> 
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

    new Chart(document.getElementById('promosPieChart'), {
        type: 'pie',
        data: promosData,
        options: chartOptions
    });

    new Chart(document.getElementById('souvenirsPieChart'), {
        type: 'pie',
        data: souvenirsData,
        options: chartOptions
    });
});

function showMagasinsWithoutPromotions() {
    const magasins = {!! \App\Models\Magasin::doesntHave('promotions')->get(['id', 'nomMagasin'])->toJson() !!};
    showMagasinsModal('Sans promotions', magasins);
}

function showMagasinsWithoutSouvenirs() {
    const magasins = {!! \App\Models\Magasin::doesntHave('souvenirs')->get(['id', 'nomMagasin'])->toJson() !!};
    showMagasinsModal('Sans souvenirs', magasins);
}

function showMagasinsModal(title, magasins) {
    let content = `
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Les magasins ci-dessous n'ont pas de Souvenirs. 
            Cliquez sur le nom d'un magasin pour en ajouter.
        </div>
        <ul class="list-group">
    `;
    
    magasins.forEach(magasin => {
        const editUrl = `${window.location.protocol}//${window.location.host}/magasins/${magasin.id}/edit?scroll=promotions`;
        content += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="${editUrl}" class="text-primary" style="text-decoration: none;">
                    ${magasin.nomMagasin}
                    <i class="fas fa-edit ms-2"></i>
                </a>
            </li>
        `;
    });
    content += '</ul>';

    Swal.fire({
        title: `Magasins ${title}`,
        html: content,
        width: 600,
        confirmButtonText: 'Fermer',
        confirmButtonColor: '#3085d6'
    });
}





</script>
@endsection