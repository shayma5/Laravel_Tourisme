@extends('layouts.backoffice')

@section('content')
<br>
<br>
<br>
<br>
<div class="card" style="margin:20px;">
  <div class="card-header">Create New Maison d'haute</div>
  <div class="card-body">
      <form method="POST" action="{{ route('backoffice.maisons.store') }}" enctype="multipart/form-data">
          @csrf <!-- CSRF protection -->

          <!-- Name Input -->
          <label>Name</label></br>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
          @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
          </br>

          <!-- Description Input -->
          <label>Description</label></br>
          <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
          @if ($errors->has('description'))
              <span class="text-danger">{{ $errors->first('description') }}</span>
          @endif
          </br>

          <!-- Number of rooms available Input -->
          <label>Number of rooms available</label></br>
          <input type="number" name="number_of_rooms" id="number_of_rooms" class="form-control" value="{{ old('number_of_rooms') }}">
          @if ($errors->has('number_of_rooms'))
              <span class="text-danger">{{ $errors->first('number_of_rooms') }}</span>
          @endif
          </br>

          <!-- Location Input -->
          <label>Location</label></br>
          <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
          @if ($errors->has('location'))
              <span class="text-danger">{{ $errors->first('location') }}</span>
          @endif
          </br>

          <!-- Image Upload -->
          <label>Image</label></br>
          <input type="file" name="image" id="image" class="form-control">
          @if ($errors->has('image'))
              <span class="text-danger">{{ $errors->first('image') }}</span>
          @endif
          </br>

          <!-- Submit Button -->
          <input type="submit" value="Save" class="btn btn-success"></br>
      </form>
  </div>
</div>
@stop
