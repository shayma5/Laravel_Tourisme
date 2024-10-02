@extends('layouts.backoffice')

@section('content')


<main>
        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="section-overlay"></div>
<div class="container">
<div class="row">
<div class="col-lg-6 col-12 mb-5 mb-lg-0" style="margin-top: 100px;">

    <h1>Ajouter Programme</h1>

    <form action="{{ route('programmes.store') }}" method="POST" style="margin-top: 100px;">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Objectif</label>
            <textarea name="objectif" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Contenu</label>
            <textarea name="contenu" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer Programme</button>
    </form>
</div>

    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
    <img src="{{ asset('assets2/img/Programmes.jpg') }}" alt="" style="margin-top: 250px; width: 100%;">
</div>
</div>
</div>
</section>
</main>
</div>

@endsection
