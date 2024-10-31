@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Modifier le Magasin</h1>

    <form action="{{ route('magasins.update', $magasin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="nomMagasin">Nom du Magasin</label>
                    <input type="text" class="form-control @error('nomMagasin') is-invalid @enderror" 
                           id="nomMagasin" name="nomMagasin" value="{{ old('nomMagasin', $magasin->nomMagasin) }}">
                    @error('nomMagasin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="type">Type</label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror" 
                           id="type" name="type" value="{{ old('type', $magasin->type) }}">
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" 
                           id="adresse" name="adresse" value="{{ old('adresse', $magasin->adresse) }}">
                    @error('adresse')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description">{{ old('description', $magasin->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @if($magasin->image)
                        <img src="{{ asset('storage/' . $magasin->image) }}" class="mt-2" style="max-width: 200px">
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <h4>Souvenirs Assignés</h4>
                    <div class="table-responsive">
                        @if($magasin->souvenirs->isEmpty())
                            <div class="alert alert-info">Aucun souvenir assigné à ce magasin</div>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($magasin->souvenirs as $souvenir)
                                        <tr>
                                            <td>{{ $souvenir->nom }}</td>
                                            <td>{{ $souvenir->prix }}€</td>
                                            <td>{{ $souvenir->nbr_restant }}</td>
                                            <td>
                                                <a href="{{ route('souvenirs.edit', $souvenir->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('loading', ['magasin' => $magasin->id, 'souvenir' => $souvenir->id]) }}" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-unlink"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Promotions</label>
                    <div class="form-check">
                        @foreach($promotions as $promotion)
                            <input type="checkbox" name="promotions[]" value="{{ $promotion->id }}" 
                                   {{ $magasin->promotions->contains($promotion->id) ? 'checked' : '' }}
                                   class="form-check-input">
                            <label class="form-check-label">{{ $promotion->nom }}</label><br>
                        @endforeach
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#souvenirModal">
                        <i class="fas fa-gift"></i> Gérer les souvenirs
                    </button>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer les modifications du magasin
                </button>
                <a href="{{ route('magasins.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="souvenirModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gérer les souvenirs de {{ $magasin->nomMagasin }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if($availableSouvenirs->isEmpty())
                        <div class="alert alert-info">
                            Aucun souvenir n'est disponible
                        </div>
                    @else
                        <form id="souvenirForm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sélectionner</th>
                                        <th>Nom</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availableSouvenirs as $souvenir)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="souvenirs[]" value="{{ $souvenir->id }}"
                                                       {{ $magasin->souvenirs->contains($souvenir->id) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $souvenir->nom }}</td>
                                            <td>{{ $souvenir->prix }}€</td>
                                            <td>{{ $souvenir->nbr_restant }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="saveSouvenirs()">
                        <i class="fas fa-save"></i> Enregistrer la sélection des souvenirs
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function saveSouvenirs() {
    const checkboxes = document.querySelectorAll('#souvenirForm input[type="checkbox"]');
    const selectedSouvenirs = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    fetch('{{ route('magasins.souvenirs.update', $magasin->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            '_token': '{{ csrf_token() }}',
            '_method': 'PUT',
            'souvenirs': selectedSouvenirs
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}
</script>

<!-- In your edit.blade.php -->
<form id="unassignForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_method" value="POST">
</form>

<script>
function confirmUnassign(souvenirId) {
    window.location.href = '/loading?magasin={{ $magasin->id }}&souvenir=' + souvenirId;
}
</script>


@endsection
