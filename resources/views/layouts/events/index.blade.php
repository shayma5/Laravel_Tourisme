{{-- @extends('layouts.app')

@section('content')

<!-- Section Hero avec bannière -->
<section class="hero-section d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('/assets/images/event.jpg') }}');">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                <div class="hero-section-text mt-5">
                    <h1 class="hero-title text-white mt-4 mb-4">Événements Récents</h1>
                    <h6 class="text-white"><strong>Plus de 10 événements à venir</strong></h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section des événements récents -->
<section class="job-section recent-jobs-section section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">

            @foreach ($events as $event)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="job-thumb job-thumb-box">
                        <!-- Image de l'événement -->
                        <div class="job-image-box-wrap">
                            <a href="{{ route('events.show', $event->id) }}">
                                <img src="{{ asset($event->photo) }}" class="job-image img-fluid" alt="{{ $event->name }}" style="width: 300px; height: 120px;">
                            </a>
                        </div>

                        <!-- Détails de l'événement -->
                        <div class="job-body">
                            <h5 class="job-title">
                                <a href="{{ route('events.show', $event->id) }}" class="job-title-link">{{ $event->name }}</a>
                            </h5>

                            <div class="d-flex align-items-center">
                                <p class="mb-0"><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><strong>Type :</strong> {{ $event->type }}</p>
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="job-location">
                                    <i class="custom-icon bi-geo-alt me-1"></i> {{ $event->location }}
                                </p>
                                <p class="job-date ms-auto">
                                    <i class="custom-icon bi-clock me-1"></i> {{ \Carbon\Carbon::parse($event->start_date)->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Description courte et lien vers les détails -->
                            <div class="border-top pt-3">
                                <p class="job-description mb-0">{{ Str::limit($event->description, 80) }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="ms-auto me-3">Détails</a>
                                <a href="" class="custom-btn btn ms-auto mt-2"> Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Bouton pour voir tous les événements -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('events.index') }}" class="custom-btn btn btn-primary">Voir tous les événements</a>
            </div>
        </div>
    </div>
</section>

@endsection --}}
@extends('layouts.app')

@section('content')

<!-- Section Hero avec bannière -->
<section class="hero-section d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('/assets/images/event.jpg') }}');">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                <div class="hero-section-text mt-5">
                    <h1 class="hero-title text-white mt-4 mb-4">Événements Récents</h1>
                    <h6 class="text-white"><strong>Plus de 10 événements à venir</strong></h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section des événements récents -->
<section class="job-section recent-jobs-section section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">

            @foreach ($events as $event)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="job-thumb job-thumb-box">
                        <!-- Image de l'événement -->
                        <div class="job-image-box-wrap">
                            <a href="{{ route('events.show', $event->id) }}">
                                <img src="{{ asset($event->photo) }}" class="job-image img-fluid" alt="{{ $event->name }}" style="width: 300px; height: 120px;">
                            </a>
                        </div>

                        <!-- Détails de l'événement -->
                        <div class="job-body">
                            <h5 class="job-title">
                                <a href="{{ route('events.show', $event->id) }}" class="job-title-link">{{ $event->name }}</a>
                            </h5>

                            <div class="d-flex align-items-center">
                                <p class="mb-0"><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><strong>Type :</strong> {{ $event->type }}</p>
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="job-location">
                                    <i class="custom-icon bi-geo-alt me-1"></i> {{ $event->location }}
                                </p>
                                <p class="job-date ms-auto">
                                    <i class="custom-icon bi-clock me-1"></i> {{ \Carbon\Carbon::parse($event->start_date)->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Description courte et lien vers les détails -->
                            <div class="border-top pt-3">
                                <p class="job-description mb-0">{{ Str::limit($event->description, 80) }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="ms-auto me-3">Détails</a>

                                <!-- Bouton pour ouvrir la fenêtre modale -->
                                <a href="#" class="custom-btn btn ms-auto mt-2" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $event->id }}">Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fenêtre modale pour la réservation -->
                <div class="modal fade" id="reservationModal{{ $event->id }}" tabindex="-1" aria-labelledby="reservationModalLabel{{ $event->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reservationModalLabel{{ $event->id }}">Réservation pour {{ $event->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('events.reserve', $event->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="participants{{ $event->id }}" class="form-label">Nombre de participants</label>
                                        <input type="number" class="form-control" id="participants{{ $event->id }}" name="participants" min="1" max="{{ $event->nbParticipant }}" required>
                                    </div>

                                    <!-- Choix du type de réservation -->
                                    <div class="mb-3">
                                        <label class="form-label">Options</label><br>
                                        <input type="radio" id="reserve{{ $event->id }}" name="option" value="reserve" checked>
                                        <label for="reserve{{ $event->id }}">Réserver sans payer</label><br>
                                        <input type="radio" id="pay{{ $event->id }}" name="option" value="pay">
                                        <label for="pay{{ $event->id }}">Payer en ligne</label>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Confirmer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <!-- Bouton pour voir tous les événements -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('events.index') }}" class="custom-btn btn btn-primary">Voir tous les événements</a>
            </div>
        </div>
    </div>
</section>

@endsection
