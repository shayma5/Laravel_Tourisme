@extends('layouts.backoffice')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center" style="margin:20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Name: {{ $maison->name }}</h1>
                <!-- Back button -->
                <button onclick="window.history.back()" class="btn btn-secondary">
                    ← Retour
                </button>
            </div>

            <div class="card-body text-center">
                <!-- Display image -->
                @if ($maison->image)
                <img src="{{ asset('storage/' . $maison->image) }}" alt="{{ $maison->name }}" style="border-radius: 30%; width: 350px; height: 350px;">
                @else
                <p>No Image Available</p>
                @endif

                <p class="card-text"><b>Number of Rooms:</b> {{ $maison->number_of_rooms }}</p>
                <p class="card-text"><b>Location:</b> {{ $maison->location }}</p>
                <p class="card-text"><b>Description:</b> {{ $maison->description }}</p>

                <!-- Display rooms list -->
                <h3>Rooms:</h3>
                @if ($maison->rooms->isNotEmpty())
                <ul class="list-group">
                    @foreach ($maison->rooms as $room)
                    <li class="list-group-item">
                        <div>
                            @if ($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" style="width: 100px; height: 100px;">
                            @endif
                        </div>
                        <div style="margin-top: 20px; margin-left: 10px;">
                            <strong>Type:</strong> {{ $room->type }}<br>
                            <strong>Price:</strong> {{ $room->price }}<br>
                            <strong>Available:</strong> {{ $room->available ? 'Yes' : 'No' }}<br>
                        </div>


                    </li>
                    @endforeach
                </ul>
                @else
                <h3>No rooms available for this Maison d'haute.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection