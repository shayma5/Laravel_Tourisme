@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Restaurants</h1>
    <div class="container mt-4">
    <form action="{{ route('restaurants.app') }}" method="GET" class="form-inline" id="filterForm">
        <div class="form-group mx-sm-3 mb-2">
            <label for="type" class="sr-only">Type de Plat</label>
            <select name="type" id="type" class="form-control" onchange="document.getElementById('filterForm').submit();">
                <option value="">Sélectionnez un type de plat</option>
                <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Tous les types</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <!-- Suppression du bouton "Filtrer" -->
    </form>
</div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-3">
        @foreach($restaurants as $restaurant)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0">
                    <img src="{{ $restaurant->image ? asset('storage/' . $restaurant->image) : asset('path/to/default-image.jpg') }}" class="card-img-top" alt="{{ $restaurant->nom }}" style="height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{ $restaurant->nom }}</h5>
                        <p class="card-text mb-1" style="font-size: 1em;"> 
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restaurant->adresse) }}" target="_blank" style="color: blue; text-decoration: none;">{{ $restaurant->adresse }}</a>
                        </p>
                        <p class="card-text mb-1" style="font-size: 1em;"> 
                            <a href="{{ $restaurant->siteWeb }}" target="_blank" style="color: blue; text-decoration: none;">{{ $restaurant->siteWeb }}</a>
                        </p>
                        <p class="card-text mb-1" style="font-size: 1em;"> {{ $restaurant->telephone }}</p>
                        <p class="card-text mb-1" style="font-size: 1em;">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($restaurant->noteMoyenne))
                                    <span class="fa fa-star text-warning"></span> <!-- Full star -->
                                @elseif ($i == ceil($restaurant->noteMoyenne))
                                    <span class="fa fa-star-half-alt text-warning"></span> <!-- Half star -->
                                @else
                                    <span class="fa fa-star text-secondary"></span> <!-- Empty star -->
                                @endif
                            @endfor
                            ({{ number_format($restaurant->noteMoyenne, 1) }})
                        </p>
                        <a href="{{ route('restaurants.show.frontend', $restaurant->id) }}" class="btn btn-info">Voir</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $restaurants->links('vendor.pagination.custom') }} <!-- Assurez-vous que le chemin est correct -->
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        typeSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>

@endsection
