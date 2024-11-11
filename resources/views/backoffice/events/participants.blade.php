@extends('layouts.backoffice')

@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Les Participants pour {{ $event->name }} </h2>
                        <button onclick="window.history.back()" class="btn btn-secondary">
                            ← Retour
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" id="searchInput" placeholder="Rechercher un participant..." class="form-control" onkeyup="searchParticipants()">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Photo de l'événement</th>                                       
                                        <th>Nom du participant</th>
                                        <th>Email du participant</th>
                                        <th>Places réservées</th>
                                        <th>Payées</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($participants as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->event->photo) }}" alt="Photo de l'événement" style="width: 100px; height: 100px;">
                                            </td>
                                            <td>{{ $item->participant->name }}</td>
                                            <td>{{ $item->participant->email }}</td>
                                            <td>{{ $item->reserved_places }}</td>
                                            <td>{{ $item->is_paid ? 'Oui' : 'Non' }}</td>
                                            <td>
                                                <form method="POST" action="{{ url('/participation/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer la participation" onclick="return confirm('Confirmer la suppression ?')">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-5">
                                <li class="page-item {{ $participants->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $participants->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">Précédent</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $participants->lastPage(); $i++)
                                    <li class="page-item {{ $participants->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $participants->url($i) }}">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endfor
                                <li class="page-item {{ $participants->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $participants->nextPageUrl() }}" aria-label="Next">
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
        function searchParticipants() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let table = document.querySelector('.table');
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let tdName = tr[i].getElementsByTagName('td')[1];
                let tdEmail = tr[i].getElementsByTagName('td')[2];
                if (tdName || tdEmail) {
                    let nameValue = tdName.textContent || tdName.innerText;
                    let emailValue = tdEmail.textContent || tdEmail.innerText;

                    if (nameValue.toLowerCase().includes(filter) || emailValue.toLowerCase().includes(filter)) {
                        tr[i].style.display = ""; 
                    } else {
                        tr[i].style.display = "none"; 
                    }
                }
            }
        }
    </script>
@endsection
