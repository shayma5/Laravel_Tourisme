@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Créer un nouveau Magasin</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('magasins.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group">
            <label for="nomMagasin">Nom du Magasin</label>
            <input type="text" class="form-control" id="nomMagasin" name="nomMagasin" value="{{ old('nomMagasin') }}" required>
            @error('nomMagasin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
            @error('type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
            @error('adresse')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <hr>
            <h4>Promotions disponibles</h4>
            <div class="card-body">
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="no_promo" name="promo_choice" value="none" checked>
                    <label class="form-check-label" for="no_promo">Sans promotion</label>
                </div>
                
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="with_promo" name="promo_choice" value="with">
                    <label class="form-check-label" for="with_promo">Avec promotion</label>
                </div>

                <div id="promotions_list" style="display: none;">
                    @if($promotions->isNotEmpty())
                        <div class="form-check">
                            @foreach($promotions as $promotion)
                                @php
                                    $daysRemaining = \Carbon\Carbon::parse($promotion->date_fin)->diffInDays(now());
                                @endphp
                                <div class="mb-2">
                                    <input type="checkbox" name="promotions[]" value="{{ $promotion->id }}" 
                                        class="form-check-input" id="promo_{{ $promotion->id }}">
                                    <label class="form-check-label" for="promo_{{ $promotion->id }}">
                                        {{ $promotion->nom }} 
                                        ({{ $promotion->date_debut }} - {{ $promotion->date_fin }})
                                        @if($daysRemaining <= 10)
                                            <span class="text-danger">({{ $daysRemaining }} jours restants)</span>
                                        @else
                                            ({{ $daysRemaining }} jours restants)
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p>Aucune promotion n'est disponible actuellement.</p>
                            <a href="{{ route('promotions.create') }}" class="btn btn-primary">Créer une nouvelle promotion</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <hr>
        <br>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[name="promo_choice"]');
    const promotionsList = document.getElementById('promotions_list');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            promotionsList.style.display = this.value === 'with' ? 'block' : 'none';
        });
    });
});
</script>
@endsection
