@extends('layouts.backoffice')

@section('content')
<br>
<br>
<br>
<br>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <h4 class="card-title">Maison d'haute List</h4>
        <a href="{{ url('/backoffice/maisons/create') }}"
          class="btn btn-primary btn-round ms-auto">
          <i class="fa fa-plus"></i>
          New Maison D'haute
        </a>
      </div>
    </div>

    <!-- Search Bar -->
    <input type="text" id="search" class="form-control" placeholder="Search..." style="width: fit-content; margin-left: 1020px;">

    <div class="card-body">
      <div class="table-responsive">
        <table id="add-row" class="display table table-striped table-hover">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Location</th>
              <th cla>Number of Rooms</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="maison-table-body">
            @foreach ($maisons as $maison)
            <tr>
              <td>
                @if ($maison->image)
                <img src="{{ asset('storage/' . $maison->image) }}" alt="{{ $maison->name }}" style="width: 50px; height: 50px;">
                @else
                No Image
                @endif
              </td>
              <td>{{ $maison->name }}</td>
              <td>{{ $maison->location }}</td>
              <td>{{ $maison->number_of_rooms }}</td>
              <td>
                <div class="form-button-action d-flex align-items-center gap-2">
                  <a href="{{ url('/backoffice/maisons/' . $maison->id) }}" class="btn btn-primary btn-sm" title="View maison" style="font-size: 1.25rem;">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>

                  <!-- Edit button -->
                  <a href="{{ url('/backoffice/maisons/' . $maison->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit" style="font-size: 1.25rem;">
                    <i class="fa fa-edit"></i>
                  </a>

                  <!-- Delete form -->
                  <form action="{{ route('backoffice.maisons.destroy', $maison->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Maison d\'hote?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Remove" style="font-size: 1.25rem;">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- AJAX Search Script -->
<script>
document.getElementById('search').addEventListener('keyup', function() {
    let query = this.value;

    // Send an AJAX request to the server
    fetch(`{{ route('backoffice.maisons.index') }}?search=${query}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => response.json())
    .then(data => {
        // Clear the current table body
        let tableBody = document.getElementById('maison-table-body');
        tableBody.innerHTML = '';

        // Append new rows based on the search result
        data.maisons.forEach(maison => {
            let row = `<tr>
                        <td>${maison.image ? `<img src="/storage/${maison.image}" alt="${maison.name}" style="width: 50px; height: 50px;">` : 'No Image'}</td>
                        <td>${maison.name}</td>
                        <td>${maison.location}</td>
                        <td>${maison.number_of_rooms}</td>
                        <td>
                          <div class="form-button-action d-flex align-items-center gap-2">
                            <a href="/backoffice/maisons/${maison.id}" class="btn btn-primary btn-sm" title="View maison"><i class="fa fa-eye"></i></a>
                            <a href="/backoffice/maisons/${maison.id}/edit" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <form action="/backoffice/maisons/${maison.id}" method="POST" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" title="Remove"><i class="fa fa-trash"></i></button>
                            </form>
                          </div>
                        </td>
                      </tr>`;
            tableBody.innerHTML += row;
        });
    });
});
</script>
@endsection
