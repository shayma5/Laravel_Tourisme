@extends('layouts.backoffice')

@section('content')
<br>
<br>
<br>
<br>
<div class="card" style="margin:20px;">
  <div class="card-header">Create New Room</div>
  <div class="card-body">
      <form method="POST" action="{{ route('backoffice.room.store') }}" enctype="multipart/form-data">
          @csrf

          <label>Maison d'haute</label></br>
          <select name="maison_id" class="form-control" required>
            <option value="">Select a Maison d'haute</option>
            @foreach($maisons as $maison)
                <option value="{{ $maison->id }}">{{ $maison->name }}</option>
            @endforeach
          </select></br>

          <label>Type</label></br>
          <select name="type" class="form-control" required>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Triple">Triple</option>
          </select></br>

          <label>Price</label></br>
          <input type="text" name="price" id="price" class="form-control" required></br>

          <label>Description</label></br>
          <textarea name="description" id="description" class="form-control" required></textarea></br>

          <label>Image</label></br>
          <input type="file" name="image" id="image" class="form-control"></br>

          <input type="submit" value="Save" class="btn btn-success"></br>
      </form>
  </div>
</div>
@endsection
