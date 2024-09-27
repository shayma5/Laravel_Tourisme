@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Restaurants</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-3">
        @foreach($restaurants as $restaurant)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurant->nom }}</h5>
                        <p class="card-text">Adresse: {{ $restaurant->adresse }}</p>
                        <p class="card-text">Site Web: {{ $restaurant->siteweb }}</p>
                        <p class="card-text">Telephone: {{ $restaurant->telephone }}</p>
                        <p class="card-text">Note Moyenne: {{ $restaurant->noteMoyenne }}</p>
                        <p class="card-text">Description: {{ $restaurant->description }}</p>
                        <!-- Seul le bouton Voir reste -->
                        <a href="{{ route('restaurants.show.frontend', $restaurant->id) }}" class="btn btn-info">Voir</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
