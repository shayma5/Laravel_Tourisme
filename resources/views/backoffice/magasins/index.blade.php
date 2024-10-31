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


   <form action="{{ route('magasins.index') }}" method="GET" class="mb-4">
      <!-- Filtre Promotions -->
      <div class="form-group mb-3">
         <h5><i class="fas fa-times-circle text-danger"></i> Filtre Promotions</h5>
         <div class="btn-group" role="group">
            <input type="radio" name="promotion_filter" value="all" class="btn-check" id="promo_all" {{ request('promotion_filter', 'all') == 'all' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="promo_all">Tous les magasins</label>
            <input type="radio" name="promotion_filter" value="with_promo" class="btn-check" id="promo_with" {{ request('promotion_filter') == 'with_promo' ? 'checked' : '' }}>
            <label class="btn btn-outline-success" for="promo_with">Avec promotion</label>

            <input type="radio" name="promotion_filter" value="no_promo" class="btn-check" id="promo_none" {{ request('promotion_filter') == 'no_promo' ? 'checked' : '' }}>
            <label class="btn btn-outline-danger" for="promo_none">Sans promotion</label>
         </div>
      </div>
      <!-- Filtre Souvenirs -->
      <div class="form-group mb-3">
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
      </div>
      <div class="form-group mb-3">
         <h5><i class="fas fa-list"></i> Nombre de magasins par page</h5>
         <div class="btn-group" role="group">
            <input type="radio" name="per_page" value="5" class="btn-check" id="per_page_5" {{ request('per_page', '10') == '5' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="per_page_5">5</label>
            <input type="radio" name="per_page" value="10" class="btn-check" id="per_page_10" {{ request('per_page', '10') == '10' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="per_page_10">10</label>
            <input type="radio" name="per_page" value="15" class="btn-check" id="per_page_15" {{ request('per_page', '10') == '15' ? 'checked' : '' }}>
            <label class="btn btn-outline-primary" for="per_page_15">15</label>
         </div>
      </div>
      <button type="submit" class="btn btn-warning">
      <i class="fas fa-filter"></i> Appliquer les filtres
      </button>
   </form>
   <hr/>
   
   
   
   <!-- Vue Liste -->
   <div id="list-view-content">
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
                        <a href="{{ route('magasins.show', $magasin->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('magasins.edit', $magasin->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('magasins.destroy', $magasin->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin ?')">Supprimer</button>
                        </form>
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
    <div id="grid-view-content" class="row" style="display: none;">
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
                                    <a href="{{ route('magasins.show', $magasin->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('magasins.edit', $magasin->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('magasins.destroy', $magasin->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce magasin ?')">Supprimer</button>
                                    </form>
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
@endsection