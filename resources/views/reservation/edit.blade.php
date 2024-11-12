@extends('layouts.app')

@section('content')

<header class="site-header">
    <div class="section-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h1 class="text-white">Modifier la Réservation</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('reservations.indexA_R') }}">Liste des Réservations</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</header>

<section class="contact-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12 mx-auto">
                <form class="custom-form contact-form" action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h2 class="text-center mb-4">Détails de la Réservation</h2>

                    <div class="form-group">
                        <label for="formation_id">Formation</label>
                        <select name="formation_id" class="form-control" required>
                            @foreach($formations as $formation)
                                <option value="{{ $formation->id }}" {{ $formation->id == $reservation->formation_id ? 'selected' : '' }}>
                                    {{ $formation->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="formateur_id">Formateur</label>
                        <select name="formateur_id" class="form-control" required>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur->id }}" {{ $formateur->id == $reservation->formateur_id ? 'selected' : '' }}>
                                    {{ $formateur->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="classe_id">Classe</label>
                        <select name="classe_id" class="form-control" required>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}" {{ $classe->id == $reservation->classe_id ? 'selected' : '' }}>
                                    {{ $classe->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="programme_id">Programme</label>
                        <select name="programme_id" class="form-control" required>
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->id }}" {{ $programme->id == $reservation->programme_id ? 'selected' : '' }}>
                                    {{ $programme->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                        <a href="{{ route('reservations.indexA_R') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
