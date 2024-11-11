@extends('layouts.backoffice')

@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Nos Événements</h2>
                    
                        <!-- Barre de recherche -->
                        <div>
                            <input type="text" id="searchInput" placeholder="Rechercher un événement..." class="form-control" onkeyup="searchEvents()">
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <a href="{{ url('/event/create') }}" class="btn btn-success btn-sm" title="Add New event">
                            Add New
                        </a>
                        
                        

                        <div class="table-responsive">
                            <table class="table" id="eventsTable">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->photo) }}" alt="Photo de l'événement" style="width: 100px; height: 100px;"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>
                                            <a href="{{ url('/event/' . $item->id) }}" title="View event">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/event/' . $item->id . '/edit') }}" title="Edit event">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ url('/event/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete event" onclick="return confirm('Confirm delete?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination links -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-5">
                                <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $events->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">Prev</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $events->lastPage(); $i++)
                                    <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ $events->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $events->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">Next</span>
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
        function searchEvents() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let table = document.getElementById('eventsTable');
            let tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let tdName = tr[i].getElementsByTagName('td')[1];
                let tdType = tr[i].getElementsByTagName('td')[2];
                let tdLocation = tr[i].getElementsByTagName('td')[5];
                if (tdName || tdType || tdLocation) {
                    let nameValue = tdName.textContent || tdName.innerText;
                    let typeValue = tdType.textContent || tdType.innerText;
                    let locationValue = tdLocation.textContent || tdLocation.innerText;

                    if (nameValue.toLowerCase().includes(filter) || 
                        typeValue.toLowerCase().includes(filter) || 
                        locationValue.toLowerCase().includes(filter)) {
                        tr[i].style.display = ""; 
                    } else {
                        tr[i].style.display = "none"; 
                    }
                }
            }
        }
    </script>
@endsection
