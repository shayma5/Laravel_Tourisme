@extends('layouts.backoffice')

@section('content')

<div class="container">
    <h1>Modifier Programme</h1>

    <form action="{{ route('programmes.update', $programme->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $programme->name }}" required />
        </div>
        <div class="mb-3">
            <label>Objectif</label>
            <textarea name="objectif" class="form-control" required>{{ $programme->objectif }}</textarea>
        </div>
        <div class="mb-3">
            <label>Contenu</label>
            <textarea name="contenu" class="form-control">{{ $programme->contenu }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour Programme</button>
    </form>
</div>

@endsection
