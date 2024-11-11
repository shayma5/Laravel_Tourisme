@extends('layouts.app')

@section('content')
<section class="event-detail-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="event-title mb-4">{{ $event->name }}</h1>
                <img src="{{ asset($event->photo) }}" alt="{{ $event->name }}" class="img-fluid rounded mb-4 shadow" style="max-width: 80%; height: auto;">
            </div>
            <div class="col-lg-12">
                <div class="event-detail p-4 border rounded shadow">
                    <p class="event-description mb-3">{{ $event->description }}</p>
                    <div class="event-info mb-3">
                        <p><strong>Type:</strong> <span class="badge bg-primary">{{ $event->type }}</span></p>
                        <p><strong>Nombre de places restantes:</strong> <span class="badge bg-success">{{ $event->nbParticipant }}</span></p>
                        <p><strong>Prix:</strong> <span class="text-danger">{{ $event->price }} TND</span></p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Date de début:</strong> <span class="text-muted">{{ $event->start_date }}</span></p>
                        <p><strong>Date de fin:</strong> <span class="text-muted">{{ $event->end_date }}</span></p>
                    </div>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Retour à la liste des événements</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .event-detail-section {
        background-color: #f8f9fa;
    }
    .event-title {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .event-description {
        font-size: 1.2rem;
    }
    .badge {
        font-size: 1rem;
    }
    .btn {
        margin-top: 20px;
    }
</style>
