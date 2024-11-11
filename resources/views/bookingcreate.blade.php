@extends('layouts.app')

@section('content')

<!-- resources/views/booking.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Include Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <title>Booking Form</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Booking Form for Room: {{ $room->name }}</h2> <!-- Display room name -->
        <p>Price: {{ $room->price }} dt</p> <!-- Display room price -->

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <!-- Other form fields -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" class="form-control" required value="+216">
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" name="start_date" id="start_date" class="form-control datepicker" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="text" name="end_date" id="end_date" class="form-control datepicker" required>
            </div>
            <button type="submit" class="btn btn-primary">Book Now</button>
        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        // Initialize Flatpickr
        document.addEventListener('DOMContentLoaded', function() {
            const startDatePicker = flatpickr("#start_date", {
                minDate: "today", // Set minimum date to today
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    // Update end date's minimum date to the selected start date
                    endDatePicker.set('minDate', dateStr);
                }
            });

            const endDatePicker = flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    // Optional: You can do something when end date changes
                }
            });
        });
    </script>

</body>

</html>



@endsection