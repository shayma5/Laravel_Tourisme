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
                <h4 class="card-title">Room List</h4>
                <a href="{{ url('/rooms/create') }}" class="btn btn-primary btn-round ms-auto">
                    <i class="fa fa-plus"></i>
                    New Room
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Maison d'haute</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Available</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                        <tr>
                            <td>
                                @if ($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->type }}" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image" style="width: 50px; height: 50px;">
                                @endif
                            </td>
                            <td>{{ $room->maisonDhaute->name }}</td>
                            <td>{{ $room->price }}</td>
                            <td>{{ $room->type }}</td>
                            <td>{{ $room->available ? 'Yes' : 'No' }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ url('/rooms/' . $room->id) }}" class="btn btn-link btn-primary btn-lg" title="View room">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ url('/rooms/' . $room->id . '/edit') }}" class="btn btn-link btn-primary btn-lg" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ url('/rooms/' . $room->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                        @csrf
                                        @method('DELETE')
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
