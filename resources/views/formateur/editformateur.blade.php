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

                            <h1 class="hero-title text-black mt-4 mb-4">Addformateurs! <br>welcome</h1>
<div class="container mt-5">
<div class="row">
    <div class="col-md-12">


    @if (session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
    @endif
        <div class="card">
            <div class="card-header">
                <h4>editFortmation
                    <a href="{{ url('admin/dashboard/formateurs') }}" class="btn btn-primary float-end">back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/dashboard/formateurs/'.$formateur->id.'/editformateur')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $formateur->name }}"/>
                        @error ('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>specialite</label>
                        <input type="text" name="specialite" class="form-control" value="{{ $formateur->specialite }}"/>
                        @error ('specialite') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">update</button>
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