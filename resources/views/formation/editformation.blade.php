@extends('layouts.backoffice')

@section('content')

<body>
    <main>
        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <div class="hero-section-text mt-5">
                            <h6 class="text-white">Is it possible to enjoy nature and preserve it?</h6>
                            <h1 class="hero-title text-black mt-4 mb-4">Edit Formation! <br>welcome</h1>

                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (session('status'))
                                            <div class="alert alert-success">{{ session('status') }}</div>
                                        @endif

                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Edit Formation
                                                    <a href="{{ url('admin/dashboard/formations') }}" class="btn btn-primary float-end">Back</a>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ url('admin/dashboard/formations/'.$formation->id .'/editformation') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ old('name', $formation->name) }}"/>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea name="description" class="form-control">{{ old('description', $formation->description) }}</textarea>
                                                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Date de Début</label>
                                                        <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut', $formation->date_debut) }}"/>
                                                        @error('date_debut') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Date de Fin</label>
                                                        <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $formation->date_fin) }}"/>
                                                        @error('date_fin') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Spécialité</label>
                                                        <select name="specialite" class="form-control">
                                                            <option value="">Choisir une spécialité</option>
                                                            <option value="formation professionnelle" {{ old('specialite', $formation->specialite) == 'formation professionnelle' ? 'selected' : '' }}>Formation Professionnelle</option>
                                                            <option value="formation touristique" {{ old('specialite', $formation->specialite) == 'formation touristique' ? 'selected' : '' }}>Formation Touristique</option>
                                                        </select>
                                                        @error('specialite') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="mb-3">
    <label>Formateur</label>
    <select name="formateur_id" class="form-control">
        <option value="">Choisir un formateur</option>
        @foreach ($formateurs as $formateur)
            <option value="{{ $formateur->id }}" {{ old('formateur_id', $formation->formateur_id) == $formateur->id ? 'selected' : '' }}>
                {{ $formateur->name }} <!-- Assurez-vous que le champ 'name' existe dans le modèle Formateur -->
            </option>
        @endforeach
    </select>
    @error('formateur_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

@endsection
