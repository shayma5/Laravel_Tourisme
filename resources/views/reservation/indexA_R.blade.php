@extends('layouts.app')

@section('content')
    
    <section class="job-section section-padding">
    <div class="container">
        <h1 class="text-center mb-4">Liste des Réservations</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($reservations as $reservation)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="job-thumb job-thumb-box">
                        <div class="job-body">
                            <h4 class="job-title">Formation : {{ $reservation->formation->name }}</h4>
                            <p>Formateur : {{ $reservation->formateur->name }}</p>
                            <p>Classe : {{ $reservation->classe->name }}</p>
                            <p>Programme : {{ $reservation->programme->name }}</p>

                            <div class="d-flex align-items-center border-top pt-3">
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="custom-btn btn ms-auto me-2">Modifier</a>

                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="custom-btn btn ms-auto">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
