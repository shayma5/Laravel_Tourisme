@extends('layouts.backoffice')
@section('content')
<div class="container">
    <div class="row" style="margin:20px;">
        <div class="card" >
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Events Page</div>
                
                <!-- Bouton retour -->
                <button onclick="window.history.back()" class="btn btn-secondary">
                    ← Retour
                </button>
            </div>
            
            <div class="card-body">
                <div class="card-body">
                     <!-- Affichage de l'image -->
                    @if($events->photo)
                        <div class="my-3">
                            <img src="{{ asset($events->photo) }}" alt="Image de l'événement" style="max-width: 100%; height: auto;">
                        </div>
                    @else
                        <p>Aucune image disponible pour cet événement.</p>
                    @endif
                    <h5 class="card-title">Name : {{ $events->name }}</h5>
                    <p class="card-text">Description : {{ $events->description }}</p>
                    <p class="card-text">Type : {{ $events->type }}</p>
                    <p class="card-text"> Participants : {{ $events->nbParticipant }}</p>
                    <p class="card-text">Price : {{ $events->price }}</p>
                    <p class="card-text">Start date : {{ $events->start_date }}</p>
                    <p class="card-text">End date : {{ $events->end_date }}</p>
                    <p class="card-text">Location : {{ $events->location }}</p>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
