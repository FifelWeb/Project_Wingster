<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

// app/Http/Controllers/BookingController.php
class BookingController extends Controller
{
    public function index()
    {
        $availableTables = Table::whereDoesntHave('reservations', function ($query) {
            $query->where('booking_time', now()); // bisa ditambah range waktu
        })->get();

        return view('booking.index', compact('availableTables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'booking_time' => 'required|date|after:now',
        ]);

        $alreadyBooked = Reservation::where('table_id', $request->table_id)
            ->where('booking_time', $request->booking_time)
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Meja sudah dipesan di waktu tersebut.');
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'table_id' => $request->table_id,
            'booking_time' => $request->booking_time,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.index')->with('success', 'Reservasi berhasil dibuat, menunggu konfirmasi admin.');
    }
}
