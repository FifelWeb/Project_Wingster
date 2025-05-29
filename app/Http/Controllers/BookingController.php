<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;


// app/Http/Controllers/BookingController.php
class BookingController extends Controller
{
    public function index(Request $request)
    {
        $availableTables = collect();

        if ($request->filled('booking_time')) {
            $bookingTime = Carbon::parse($request->input('booking_time'));
            $rangeStart = $bookingTime->copy()->subHour();
            $rangeEnd = $bookingTime->copy()->addHour();

            $availableTables = Table::whereDoesntHave('reservations', function ($query) use ($rangeStart, $rangeEnd) {
                $query->whereBetween('booking_time', [$rangeStart, $rangeEnd]);
            })->get();
        }

        return view('frontend.booking.index', compact('availableTables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'booking_time' => 'required|date|after_or_equal:now',
        ]);

        $bookingTime = Carbon::parse($request->input('booking_time'));
        $rangeStart = $bookingTime->copy()->subHour();
        $rangeEnd = $bookingTime->copy()->addHour();

        // Cek apakah meja tersedia
        $isBooked = Reservation::where('table_id', $request->table_id)
            ->whereBetween('booking_time', [$rangeStart, $rangeEnd])
            ->exists();

        if ($isBooked) {
            return back()->withErrors(['table_id' => 'Meja sudah dibooking di waktu tersebut. Silakan pilih yang lain.']);
        }

        // Simpan booking
        Reservation::create([
            'user_id' => auth()->id(),
            'table_id' => $request->table_id,
            'booking_time' => $bookingTime,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.index')->with('success', 'Reservasi berhasil dibuat.');
    }
}
