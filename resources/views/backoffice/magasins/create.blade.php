@extends('layouts.backoffice')

@section('content')
<div class="container">
    <h1>Créer un nouveau Magasin</h1>
    <form action="{{ route('magasins.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nomMagasin">Nom du Magasin</label>
            <input type="text" class="form-control" id="nomMagasin" name="nomMagasin" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
        <hr></hr>
            <h4>Promotions</h4>
            <div class="card-body">
                @if($promotions->isNotEmpty())
                    <div class="table-responsive">
                        <table id="promotions-table" class="display table table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>Sélectionner</th>
                                    <th>Nom de la promotion</th>
                                    <th>Description</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($promotions as $promotion)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="promotions[]" value="{{ $promotion->id }}" id="promotion{{ $promotion->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $promotion->nom }}</td>
                                        <td>{{ Str::limit($promotion->description, 50) }}</td>
                                        <td>{{ $promotion->date_debut }}</td>
                                        <td>{{ $promotion->date_fin }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                
                    <span>Aucune promotion disponible actuellement.</span>
                    <a href="{{ route('promotions.create') }}" class="btn btn-primary">Créer une nouvelle promotion</a>
                @endif
            </div>
        </div>
        <hr/>
        <br/>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
