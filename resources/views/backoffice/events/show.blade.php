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
                <h5 class="card-title">Name : {{ $events->name }}</h5>
                <p class="card-text">Description : {{ $events->description }}</p>
                <p class="card-text">Type : {{ $events->type }}</p>
                <p class="card-text">Start date : {{ $events->start_date }}</p>
                <p class="card-text">End date : {{ $events->end_date }}</p>
                <p class="card-text">Location : {{ $events->location }}</p>
                </div>
            </hr>
        </div>
        </div>
    </div>
</div>
@endsection