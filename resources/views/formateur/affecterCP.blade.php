@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Affecter des classes à {{ $classe->name }}</h1>
    <form action="{{ route('classes.affecterCF.store', $classe->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="formateurs">Sélectionnez les formateurs :</label>
            <select name="formateurs[]" id="formateurs" class="form-control" multiple>
                @foreach($formateurs as $formateur)
                    <option value="{{ $formateur->id }}">{{ $formateur->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Affecter</button>
    </form>
</div>
@endsection



