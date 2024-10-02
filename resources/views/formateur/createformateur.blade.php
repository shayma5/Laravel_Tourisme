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
                            <h1 class="hero-title text-black mt-4 mb-4">Add Formateurs! <br>welcome</h1>

                            @if (session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <h4>Add Formation
                                        <a href="{{ url('admin/dashboard/formateurs') }}" class="btn btn-primary float-end">Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/dashboard/formateurs/createformateur') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Spécialité</label>
                                            <input type="text" name="specialite" class="form-control" value="{{ old('specialite') }}"/>
                                            @error('specialite') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                </div>
                <div class="col-lg-6 col-12 mb-5 mb-lg-0">
    <img src="{{ asset('assets2/img/formateur.jpg') }}" alt="" style="margin-top: 200px;  width: 100%;">
</div>                    </div>
            </div>
        </section>
    </main>
</body>

@endsection
