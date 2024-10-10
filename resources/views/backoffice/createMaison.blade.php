@extends('layouts.backoffice')

@section('content')
<br>
<br>
<br>
<br>
<div class="card" style="margin:20px;">
  <div class="card-header">Create New Maison d'haute</div>
  <div class="card-body">
      <form method="POST" action="{{ route('maisons.store') }}" enctype="multipart/form-data">
          @csrf <!-- CSRF protection -->
          <label>Name</label></br>
          <input type="text" name="name" id="name" class="form-control" required></br>

          <label>Description</label></br>
          <textarea name="description" id="description" class="form-control" required></textarea></br>

          <label>Number of rooms available</label></br>
          <input type="number" name="number_of_rooms" id="number_of_rooms" class="form-control" required></br>

          <label>Location</label></br>
          <input type="text" name="location" id="location" class="form-control" required></br>

          <label>Image</label></br>
          <input type="file" name="image" id="image" class="form-control"></br>

          <input type="submit" value="Save" class="btn btn-success"></br>
      </form>
  </div>
</div>
@stop
