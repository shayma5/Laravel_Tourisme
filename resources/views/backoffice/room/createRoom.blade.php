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

          <!-- Maison d'haute Selection -->
          <label>Maison d'haute</label></br>
          <select name="maison_id" class="form-control">
            <option value="">Select a Maison d'haute</option>
            @foreach($maisons as $maison)
                <option value="{{ $maison->id }}" {{ old('maison_id') == $maison->id ? 'selected' : '' }}>{{ $maison->name }}</option>
            @endforeach
          </select>
          @if ($errors->has('maison_id'))
              <span class="text-danger">{{ $errors->first('maison_id') }}</span>
          @endif
          </br>

          <!-- Type Selection -->
          <label>Type</label></br>
          <select name="type" class="form-control">
            <option value="Single" {{ old('type') == 'Single' ? 'selected' : '' }}>Single</option>
            <option value="Double" {{ old('type') == 'Double' ? 'selected' : '' }}>Double</option>
            <option value="Triple" {{ old('type') == 'Triple' ? 'selected' : '' }}>Triple</option>
          </select>
          @if ($errors->has('type'))
              <span class="text-danger">{{ $errors->first('type') }}</span>
          @endif
          </br>

          <!-- Price Input -->
          <label>Price</label></br>
          <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
          @if ($errors->has('price'))
              <span class="text-danger">{{ $errors->first('price') }}</span>
          @endif
          </br>

          <!-- Description Input -->
          <label>Description</label></br>
          <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
          @if ($errors->has('description'))
              <span class="text-danger">{{ $errors->first('description') }}</span>
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
@endsection
