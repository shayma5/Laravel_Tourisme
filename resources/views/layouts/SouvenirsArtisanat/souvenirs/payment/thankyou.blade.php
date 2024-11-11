@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3>Merci pour votre achat !</h3>
                </div>
                <div class="card-body">
                    @if(session('souvenir'))
                        @php $souvenir = session('souvenir'); @endphp
                        <p class="lead">Nous vous remercions d'avoir acheté {{ $souvenir->nom }}.</p>
                    @endif
                    <p>Votre commande sera traitée et expédiée dans les plus brefs délais.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
