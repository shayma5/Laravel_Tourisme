@extends('layouts.backoffice')

@section('content')
<br>
<br>
<br>
<br>
<div class="card" style="margin:20px;">
  <div class="card-header">Edit Room</div>
  <div class="card-body">
      <form method="POST" action="{{ route('backoffice.room.update', ['maisonDhaute' => $maisonDhaute->id, 'room' => $room->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT') <!-- Include the PUT method for update -->

          <label>Type</label></br>
          <select name="type" class="form-control" required>
              <option value="Single" {{ $room->type == 'Single' ? 'selected' : '' }}>Single</option>
              <option value="Double" {{ $room->type == 'Double' ? 'selected' : '' }}>Double</option>
              <option value="Triple" {{ $room->type == 'Triple' ? 'selected' : '' }}>Triple</option>
          </select></br>

          <label>Price</label></br>
          <input type="text" name="price" id="price" class="form-control" value="{{ $room->price }}" required></br>

          <label>Description</label></br>
          <textarea name="description" id="description" class="form-control" required>{{ $room->description }}</textarea></br>

          <label>Available</label></br>
          <select name="available" class="form-control" required>
              <option value="1" {{ $room->available ? 'selected' : '' }}>Yes</option>
              <option value="0" {{ !$room->available ? 'selected' : '' }}>No</option>
          </select></br>

          <label>Image</label></br>
          @if ($room->image)
              <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" style="width: 100px; height: 100px;">
          @endif
          <input type="file" name="image" id="image" class="form-control"></br>

          <input type="submit" value="Save" class="btn btn-success"></br>
      </form>
  </div>
</div>
@endsection
