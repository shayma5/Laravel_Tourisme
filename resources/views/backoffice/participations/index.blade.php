@extends('layouts.backoffice')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Nos Evenements</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Photo de l'événement</th>
                                        <th>Nom de l'événement</th>
                                        <th>Nom du participant</th>
                                        <th>Email du participant</th>
                                        <th>Places réservées</th> <!-- Nouvelle colonne pour le nombre de places réservées -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($participations as $item)
                                    <tr>
                                        <!-- Afficher la photo de l'événement -->
                                        <td>
                                            <img src="{{ asset($item->event->photo) }}" alt="Photo de l'événement" style="width: 100px; height: 100px;">
                                        </td>
                                        
                                        <!-- Afficher le nom de l'événement -->
                                        <td>{{ $item->event->name }}</td>

                                        <!-- Afficher le nom du participant -->
                                        <td>{{ $item->participant->name }}</td>

                                        <!-- Afficher l'email du participant -->
                                        <td>{{ $item->participant->email }}</td>

                                        <!-- Afficher le nombre de places réservées -->
                                        <td>{{ $item->reserved_places }}</td> <!-- Affichage du nombre de places réservées -->

                                        <td>
                                            <a href="{{ url('/participation/' . $item->id) }}" title="View participation">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Voir
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/participation/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete participation" onclick="return confirm('Confirmer la suppression ?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
