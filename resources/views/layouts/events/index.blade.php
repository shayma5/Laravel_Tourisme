@extends('layouts.app')

@section('content')

{{-- <!-- Section Hero avec bannière -->
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
</section> --}}

<!-- Section des événements récents -->
<section class="job-section recent-jobs-section section-padding">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="search-advanced mb-4">
            <input type="text" id="searchName" placeholder="Nom de l'événement..." class="form-control" onkeyup="filterEvents()">
           
        </div>
        
        <div class="row align-items-center justify-content-center" >

            @foreach ($events as $event)
                <div class="col-lg-3 col-md-4 col-6 mb-4" >
                    <div class="job-thumb job-thumb-box">
                        <!-- Image de l'événement -->
                        <div class="job-image-box-wrap">
                            <a href="{{ route('events.show', $event->id) }}">
                                <img src="{{ asset($event->photo) }}" class="job-image img-fluid" alt="{{ $event->name }}" style= "width: 300px; height: 170px;">
                            </a>
                        </div>

                        <!-- Détails de l'événement -->
                        <div class="job-body" >
                            <h5 class="job-title">
                                <a href="{{ route('events.show', $event->id) }}" style= "font-size: 1.35rem" class="job-title-link">{{ $event->name }} </a>
                            </h5>
                            <div class="d-flex align-items-center">
                                <p class="mb-0" style= "font-size: 0.85rem"><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0" style= "font-size: 0.85rem"><strong>Type :</strong> {{ $event->type }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="job-location" style= "font-size: 0.85rem">
                                    <i class="custom-icon bi-geo-alt me-1"></i> {{ Str::limit( $event->location, 10) }}
                                </p>
                                <p class="job-date ms-auto">
                                    <i class="custom-icon bi-clock me-1" style="font-size: 0.85rem;"></i> 
                                    {{ \Carbon\Carbon::parse($event->start_date)->diffForHumans() }}
                                </p>
                                
                            </div>

                            <!-- Description courte et lien vers les détails -->
                            <div class="border-top pt-3">
                                <p class="job-description mb-0" style= "font-size: 0.95rem" >{{ Str::limit($event->description, 10) }}</p>

                                <a href="{{ route('events.show', $event->id) }}" class="ms-auto me-3">Détails</a>

                                <!-- Bouton pour ouvrir la fenêtre modale -->
                                <a href="#" class="custom-btn btn ms-auto mt-2" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $event->id }}">Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fenêtre modale pour la réservation -->
                <!-- Modal de réservation -->
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

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-5">
                <!-- Lien Précédent -->
                <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $events->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">Prev</span>
                    </a>
                </li>

                <!-- Liens des pages -->
                @for ($i = 1; $i <= $events->lastPage(); $i++)
                    <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <!-- Lien Suivant -->
                <li class="page-item {{ $events->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $events->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>
            </ul>
        </nav>

       
        
    </div>
    
</section>
<script>
    function filterEvents() {
        const nameInput = document.getElementById('searchName').value.toLowerCase();
        

        const eventCards = document.querySelectorAll('.job-thumb');

        eventCards.forEach(card => {
            const title = card.querySelector('.job-title-link').textContent.toLowerCase();
            
            // Vérifiez si le titre, le type et la date correspondent aux critères de recherche
            const matchesName = title.includes(nameInput);
            
            if (matchesName ) {
                card.style.display = ""; // Afficher la carte si elle correspond
            } else {
                card.style.display = "none"; // Masquer la carte si elle ne correspond pas
            }
        });
    }
</script>
<script src="https://js.stripe.com/v3/"></script>


@endsection
