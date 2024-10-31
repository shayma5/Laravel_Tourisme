@extends('layouts.backoffice')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <div class="alert alert-info">Aucun souvenir n'est pour l'instant assigné à ce magasin</div>
                            <div class="form-group mb-3">
                            <!-- Bouton pour ouvrir le pop-up de gestion des souvenirs -->

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#souvenirModal">
                                    <i class="fas fa-gift"></i> Gérer les souvenirs
                                </button>
                            </div>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" id="select-all-souvenirs" onclick="toggleAllSouvenirs()">
                                        </th>
                                        <th class="text-center">Nom</th>
                                        <th class="text-center">Prix</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($magasin->souvenirs as $souvenir)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="souvenirs_to_unassign[]" value="{{ $souvenir->id }}" class="souvenir-unassign-select">
                                            </td>
                                            <td class="text-center"><a href="{{ route('souvenirs.show', $souvenir->id) }}">{{ $souvenir->nom }}</a></td>
                                            <td class="text-center">{{ $souvenir->prix }}€</td>
                                            <td class="text-center">{{ $souvenir->nbr_restant }}</td>
                                            <td >
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
                            <div class="form-group mb-3">
                            <!-- Bouton pour ouvrir le pop-up de gestion des souvenirs -->

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#souvenirModal">
                                    <i class="fas fa-gift"></i> Gérer les souvenirs
                                </button>
                                <button type="button" class="btn btn-danger" id="unassign-button" onclick="unassignSelectedSouvenirs()" disabled>
                                    Désaffecter les souvenirs sélectionnés
                                </button>
                            </div>
                           
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


            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer les modifications du magasin
                </button>
                <a href="{{ route('magasins.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>

    <!-- Modal pour gérer les souvenirs  -->
    <div class="modal fade" id="souvenirModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gérer les souvenirs de {{ $magasin->nomMagasin }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Liste des Souvenirs</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-all-tab-nobd" data-bs-toggle="pill" href="#pills-all-nobd" role="tab" aria-selected="true">
                                        Tous les souvenirs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-owned-tab-nobd" data-bs-toggle="pill" href="#pills-owned-nobd" role="tab" aria-selected="false">
                                        Souvenirs affectés ✔️
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-not-owned-tab-nobd" data-bs-toggle="pill" href="#pills-not-owned-nobd" role="tab" aria-selected="false">
                                        Souvenirs non affectés ❌
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                <div class="tab-pane fade show active" id="pills-all-nobd" role="tabpanel">
                                    <table class="table">
                                    @include('backoffice.magasins._souvenirs_table', ['souvenirs' => $souvenirs, 'tableId' => 'all-souvenirs'])
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-owned-nobd" role="tabpanel">
                                    <table class="table">
                                    @include('backoffice.magasins._souvenirs_table', ['souvenirs' => $ownedSouvenirs, 'tableId' => 'owned-souvenirs'])
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-not-owned-nobd" role="tabpanel">
                                    <table class="table">
                                    @include('backoffice.magasins._souvenirs_table', ['souvenirs' => $notOwnedSouvenirs, 'tableId' => 'not-owned-souvenirs'])
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSouvenirModal">
                    <i class="fas fa-plus"></i> Ajouter un souvenir
                </button>

                    <button type="button" class="btn btn-success" onclick="saveSouvenirs()">
                        <i class="fas fa-save"></i> Enregistrer la sélection des souvenirs
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal pour créer un nouveau souvenir -->
<div class="modal fade" id="createSouvenirModal">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer un nouveau souvenir</h5>
                <button type="button" class="btn-close" onclick="window.location.href='{{ route('magasins.edit', $magasin->id) }}'"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="createSouvenirForm" action="{{ route('loading.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="number" step="0.01" class="form-control @error('prix') is-invalid @enderror" id="prix" name="prix" value="{{ old('prix') }}" required>
                        @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="promotion">Promotion</label>
                        <input type="number" step="0.01" class="form-control @error('promotion') is-invalid @enderror" id="promotion" name="promotion" value="{{ old('promotion') }}">
                        @error('promotion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nbr_restant">Nombre restant</label>
                        <input type="number" class="form-control @error('nbr_restant') is-invalid @enderror" id="nbr_restant" name="nbr_restant" value="{{ old('nbr_restant') }}" required>
                        @error('nbr_restant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="magasin_id" value="{{ $magasin->id }}">

                    <hr>
                    <div class="validation-rules">
                        <h6>Règles de validation :</h6>
                        <ol>
                            <li>Le nom est obligatoire et doit contenir maximum 255 caractères</li>
                            <li>Le prix est obligatoire et doit être un nombre positif</li>
                            <li>La description est obligatoire</li>
                            <li>La promotion est optionnelle mais doit être un pourcentage valide (entre 0 et 100)</li>
                            <li>Le nombre restant est obligatoire et doit être un nombre entier positif</li>
                            <li>L'image est optionnelle mais doit être au format jpeg, png, jpg ou gif (max: 2Mo)</li>
                        </ol>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('magasins.edit', $magasin->id) }}'">Annuler</button>
                        <button type="submit" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true;">Ajouter le souvenir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function saveSouvenirs() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('magasins.souvenirs.update', $magasin->id) }}';
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);

    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    form.appendChild(methodInput);

    // Get only checked checkboxes
    const checkedBoxes = document.querySelectorAll('input[name="souvenirs[]"]:checked');
    checkedBoxes.forEach(checkbox => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'souvenirs[]';
        input.value = checkbox.value;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
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




<script>
document.getElementById('createSouvenirForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Fermer le modal de création
            $('#createSouvenirModal').modal('hide');
            // Rafraîchir la liste des souvenirs dans le premier modal
            // Ajouter le nouveau souvenir à la liste
            // Réafficher le premier modal
            $('#manageSouvenirsModal').modal('show');
        }
    });
});
</script>

<script>
document.querySelector('#createSouvenirModal .btn-close').addEventListener('click', function() {
    const createModal = document.getElementById('createSouvenirModal');
    const manageModal = document.getElementById('souvenirModal');
    
    const bsCreateModal = bootstrap.Modal.getInstance(createModal);
    const bsManageModal = bootstrap.Modal.getInstance(manageModal);
    
    bsCreateModal.hide();
    bsManageModal.show();
});
</script>

<script>
function unassignSelectedSouvenirs() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('magasins.souvenirs.unassign-multiple', $magasin->id) }}';
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);

    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    form.appendChild(methodInput);

    const selectedSouvenirs = document.querySelectorAll('.souvenir-unassign-select:checked');
    selectedSouvenirs.forEach(checkbox => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'souvenirs_to_unassign[]';
        input.value = checkbox.value;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}
</script>

<script>
function updateUnassignButton() {
    const selectedSouvenirs = document.querySelectorAll('.souvenir-unassign-select:checked');
    const unassignButton = document.getElementById('unassign-button');
    unassignButton.disabled = selectedSouvenirs.length === 0;
}

function toggleAllSouvenirs() {
    const mainCheckbox = document.getElementById('select-all-souvenirs');
    const checkboxes = document.getElementsByClassName('souvenir-unassign-select');
    
    for (let checkbox of checkboxes) {
        checkbox.checked = mainCheckbox.checked;
    }
    updateUnassignButton();
}

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.getElementsByClassName('souvenir-unassign-select');
    for (let checkbox of checkboxes) {
        checkbox.addEventListener('change', updateUnassignButton);
    }
});
</script>




@endsection
