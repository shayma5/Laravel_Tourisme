@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Affecter des programmes à {{ $formation->name }}</h1>
    <form action="{{ route('formations.affecter', $formation->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="programmes">Sélectionnez les programmes :</label>
            <select name="programmes[]" id="programmes" class="form-control" multiple>
                @foreach($programmes as $programme)
                    <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Affecter</button>
    </form>
</div>
@endsection
