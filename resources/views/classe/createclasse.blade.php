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
                            <h1 class="hero-title text-black mt-4 mb-4">Add Classe! <br>welcome</h1>

                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (session('status'))
                                            <div class="alert alert-success">{{ session('status') }}</div>
                                        @endif

                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Add Classe
                                                    <a href="{{ url('admin/dashboard/classes') }}" class="btn btn-primary float-end">Back</a>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ url('admin/dashboard/classes/createclasse') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Specialite</label>
                                                        <textarea name="specialite" class="form-control">{{ old('specialite') }}</textarea>
                                                        @error('specialite') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                   
                                                    <div class="mb-3">
    <label>Programme</label>
    <select name="programme_id" class="form-control">
        <option value="">Choisir un programme</option>
        @foreach ($programmes as $programme)
            <option value="{{ $programme->id }}" {{ old('programme_id') == $programme->id ? 'selected' : '' }}>
                {{ $programme->name }} <!-- Assurez-vous que le champ 'name' existe dans le modèle programme -->
            </option>
        @endforeach
    </select>
    @error('programme_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>

                                                    
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
    <img src="{{ asset('assets2/img/classe.jpg') }}" alt="" style="margin-top: 220px;  width: 100%;">
</div> 
                </div>
            </div>
        </section>
    </main>
</body>

@endsection
