<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Services\SmsService; // Import the SMS service

class BookingController extends Controller
{
    protected $smsService; // Declare a property for the SMS service

    // Inject the SmsService in the constructor
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService; // Assign the injected SMS service to the property
    }

    // Index function to display all bookings
    public function index()
    {
        $bookings = Booking::all(); // Fetch all bookings
        return view('backoffice.booking', compact('bookings')); // Return the bookings view with the bookings data
    }

    // Modify the create method to accept a room ID
    public function create($roomId)
    {
        // Fetch the specific room based on the provided room ID
        $room = Room::findOrFail($roomId); // This will throw a 404 if the room does not exist
        return view('bookingcreate', compact('room')); // Return the booking view with room details
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Create the booking record
        $booking = Booking::create($request->all());

        // Prepare the SMS message
        $message = "Thank you, {$request->first_name} {$request->last_name}! Your booking for room is confirmed from {$request->start_date} to {$request->end_date}.";

        // Send SMS confirmation
        $this->smsService->sendSms($request->phone, $message);

        return redirect()->route('bookings.store', ['roomId' => $request->room_id])->with('success', 'Booking successful! An SMS confirmation has been sent.');
    }

    // Add the delete function
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id); // Find the booking by ID or throw 404

        // Optionally, you could send a cancellation SMS message
        $message = "Dear {$booking->first_name} {$booking->last_name}, your booking for room has been canceled.";
        $this->smsService->sendSms($booking->phone, $message);

        // Delete the booking
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully! A cancellation SMS has been sent.');
    }
}
