@extends('layouts.backoffice')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
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
            <label>Promotions</label>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        
                        <input type="text" id="search" class="form-control" placeholder="Rechercher une promotion2...">
                    </div>
                </div>
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
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

{# <script>
$(document).ready(function() {
    $('#searchPromotion').on('keyup', function() {
        var query = $(this).val();
        console.log(query);
        $.ajax({
            url: "{{ route('promotions.search') }}",
            method: 'GET',
            data: {query: query},
            success: function(data) {
                var tbody = $('#promotions-table tbody');
                tbody.empty();
                $.each(data, function(index, promotion) {
                    tbody.append(`
                        <tr>
                            /* <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="promotions[]" value="${promotion.id}" id="promotion${promotion.id}">
                                </div>
                            </td> */
                            <td>${promotion.nom}</td>
                            <td>${promotion.description.substring(0, 50)}...</td>
                            <td>${promotion.date_debut}</td>
                            <td>${promotion.date_fin}</td>
                        </tr>
                    `);
                });
            }
        });
    });
});</script> #}


<script>
    $(document).on('keyup',function(e){
        e.preventDefault();
        let search_string = $('#search').val();
        $.ajax({
            url: "{{ route('promotions.search') }}",
            method: 'GET', 
            data:{search_string:search_string},
            success:function(res){
                $('.table-data').html(res);
            }

        });
    });
</script>

@endsection
