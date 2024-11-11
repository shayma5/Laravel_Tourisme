@extends('layouts.backoffice')

@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Nos Participations</h2>
                    
                        <!-- Barre de recherche -->
                        
                        <div>
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom d'utilisateur ou nom d'événement" onkeyup="filterTable()">

                        </div>
                    </div>
                    
                    <div class="card-body">
                        

                        <div class="table-responsive">
                            <table class="table" id="participationTable">
                                <thead>
                                    <tr>
                                        <th>Photo de l'événement</th>
                                        <th>Nom de l'événement</th>
                                        <th>Nom du participant</th>
                                        <th>Email du participant</th>
                                        <th>Places réservées</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($participations as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->event->photo) }}" alt="Photo de l'événement" style="width: 100px; height: 100px;">
                                        </td>
                                        <td>{{ $item->event->name }}</td>
                                        <td>{{ $item->participant->name }}</td>
                                        <td>{{ $item->participant->email }}</td>
                                        <td>{{ $item->reserved_places }}</td>
                                        <td>
                                            <a href="{{ url('/participation/' . $item->id) }}" title="Voir participation">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Voir
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ url('/participation/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer participation" onclick="return confirm('Confirmer la suppression ?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <nav aria-label="Navigation des pages">
                            <ul class="pagination justify-content-center mt-5">
                                <li class="page-item {{ $participations->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $participations->previousPageUrl() }}" aria-label="Précédent">
                                        <span aria-hidden="true">Précédent</span>
                                    </a>
                                </li>

                                @for ($i = 1; $i <= $participations->lastPage(); $i++)
                                    <li class="page-item {{ $participations->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $participations->url($i) }}">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endfor

                                <li class="page-item {{ $participations->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $participations->nextPageUrl() }}" aria-label="Suivant">
                                        <span aria-hidden="true">Suivant</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterTable() {
            // Récupérer la valeur du champ de recherche
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const table = document.getElementById("participationTable");
            const rows = table.getElementsByTagName("tr");

            // Parcourir toutes les lignes de la table (à partir de la deuxième ligne)
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let found = false;

                // Vérifier chaque cellule de la ligne pour la correspondance
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        const cellValue = cells[j].textContent || cells[j].innerText;
                        if (cellValue.toLowerCase().indexOf(searchInput) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                // Afficher ou masquer la ligne en fonction de la correspondance
                rows[i].style.display = found ? "" : "none";
            }
        }
    </script>
@endsection
