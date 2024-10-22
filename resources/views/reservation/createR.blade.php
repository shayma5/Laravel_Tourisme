@extends('layouts.app')

@section('content')

<header class="site-header">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h1 class="text-white">Duree de formation</h1>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">{{ $formation->date_debut }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $formation->date_fin }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</header>

<section class="contact-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12 mb-lg-5 mb-3">
                <div id="map" style="height: 300px; border-radius: 15px;"></div>                       
            </div>

            <div class="col-lg-5 col-12 mb-3 mx-auto">
                <div class="contact-info-wrap">
                    <div class="contact-info d-flex align-items-center mb-3">
                        <i class="custom-icon bi-building"></i>
                        <p class="mb-0">
                            <span class="contact-info-small-title">formation</span>
                            {{ $formation->name }}
                        </p>
                    </div>

                    <div class="contact-info d-flex align-items-center">
                        <i class="custom-icon bi-globe"></i>
                        <p class="mb-0">
                            <span class="contact-info-small-title">description</span>
                            <a href="#" class="site-footer-link">{{ $formation->description }}</a>
                        </p>
                    </div>

                    <div class="contact-info d-flex align-items-center">
                        <i class="custom-icon bi-telephone"></i>
                        <p class="mb-0">
                            <span class="contact-info-small-title">formateur</span>
                            <a href="tel:305-240-9671" class="site-footer-link">{{ $formation->formateur ? $formation->formateur->name : 'No Formateur' }}</a>
                        </p>
                    </div>

                    <div class="contact-info d-flex align-items-center">
                        <i class="custom-icon bi-envelope"></i>
                        <p class="mb-0">
                            <span class="contact-info-small-title">specialite</span>
                            <a href="mailto:info@yourgmail.com" class="site-footer-link">{{ $formation->specialite }}</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-12 mx-auto">
                <form class="custom-form contact-form" action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <h2 class="text-center mb-4">Project in mind? Let’s Talk</h2>
                    <input type="hidden" name="formation_id" value="{{ $formation->id }}">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <label for="first-name">formateur</label>
                            <select name="formateur_id" class="form-control" required>
                                <option value="">Sélectionnez un formateur</option>
                                @if ($formation->formateur)
                                <option value="{{ $formation->formateur->id }}">{{ $formation->formateur->name }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <label for="email">classe</label>
                            <select name="classe_id" class="form-control" id="classeSelect" required>
                                <option value="">Sélectionnez une classe</option>
                                @foreach ($formation->programmes as $programme)
                                    @foreach ($programme->classes as $classe)
                                        <option value="{{ $classe->id }}" data-localisation="{{ $classe->localisation }}">{{ $classe->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-12 col-12">
                            <label for="message">programme</label>
                            <select name="programme_id" class="form-control" required>
                                <option value="">Sélectionnez un programme</option>
                                @foreach ($formation->programmes as $programme)
                                    <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4 col-6 mx-auto">
                            <button type="submit" class="form-control">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    let map;
    let eventMarker;

    function initMap(lat, lon) {
        map = L.map('map').setView([lat, lon], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        eventMarker = L.marker([lat, lon]).addTo(map);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const initialLat = "{{ $formation->latitude }}"; // Change this to your default latitude
        const initialLon = "{{ $formation->longitude }}"; // Change this to your default longitude
        initMap(initialLat, initialLon);

        document.getElementById('classeSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const localisation = selectedOption.getAttribute('data-localisation');

            // Fetch the new coordinates based on localisation or address
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(localisation)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = data[0].lat;
                        const lon = data[0].lon;
                        eventMarker.setLatLng([lat, lon]);
                        map.setView([lat, lon], 13);
                    } else {
                        alert("Adresse de la classe introuvable.");
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la requête Nominatim:', error);
                });
        });
    });
</script>

@endsection
