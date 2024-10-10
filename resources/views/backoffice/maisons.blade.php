@extends('layouts.backoffice')

@section('content')
<br>
<br>
<br>
<br>
<div class="col-md-12" >
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <h4 class="card-title">Maison d'haute List</h4>
        <a href="{{ url('/maisons/create') }}"
          class="btn btn-primary btn-round ms-auto">
          <i class="fa fa-plus"></i>
          New Maison D'haute
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="add-row" class="display table table-striped table-hover">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Location</th>
              <th>Number of Rooms</th>
              <th style="width: 10%">Action</th>
            </tr>
          </thead>
          <tbody>
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
                <div class="form-button-action">
                <a href="{{ url('/maisons/' . $maison->id) }}" class="btn btn-link btn-primary btn-lg" title="View maison"><i class="fa fa-eye" aria-hidden="true"></i></a>

                  <!-- Edit button -->
                  <a href="{{ url('/maisons/' . $maison->id . '/edit') }}" class="btn btn-link btn-primary btn-lg" title="Edit">
                    <i class="fa fa-edit"></i>
                  </a>

                  <!-- Delete form -->
                  <form action="{{ route('maisons.destroy', $maison->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this Maison d\'haute?');">
                    @csrf
                    @method('DELETE') <!-- Required to make DELETE request -->
                    <button type="submit" class="btn btn-link btn-danger" title="Remove">
                      <i class="fa fa-times"></i>
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

@endsection
