@extends('layouts.backoffice')
@section('content')
<br>
<br>
<br>
<br>
<div class="card" style="margin:20px;">
  <div class="card-header">Edit Maison d'haute</div>
  <div class="card-body">

    <!-- Form to update Maison d'haute -->
    <form action="{{ route('maisons.update', $maisons->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH') <!-- Required for PATCH request -->

      <!-- Name field -->
      <label>Name</label>
      <input type="text" name="name" id="name" value="{{ $maisons->name }}" class="form-control">
      @error('name')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <!-- Description field -->
      <label>Description</label>
      <textarea name="description" id="description" class="form-control">{{ $maisons->description }}</textarea>
      @error('description')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <!-- Number of rooms field -->
      <label>Number of rooms available</label>
      <input type="number" name="number_of_rooms" id="number_of_rooms" value="{{ $maisons->number_of_rooms }}" class="form-control">
      @error('number_of_rooms')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <!-- Location field -->
      <label>Location</label>
      <input type="text" name="location" id="location" value="{{ $maisons->location }}" class="form-control">
      @error('location')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <!-- Image field -->
      <label>Image</label>
      <input type="file" name="image" id="image" class="form-control">
      @if ($maisons->image)
        <img src="{{ asset('storage/' . $maisons->image) }}" alt="Maison Image" width="100" style="margin-top: 10px;">
      @endif
      @error('image')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    <br>
      <!-- Submit button -->
      <input type="submit" value="Save" class="btn btn-success" style="margin-top: 10px;">
    </form>

  </div>
</div>
@stop
