<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

// app/Http/Controllers/AdminController.php
class AdminController extends Controller
{
    public function admin()
    {
        // Ambil semua reservasi, urutkan dari yang terbaru atau berdasarkan tanggal/jam
        $reservations = Reservation::with('table') // Mengambil detail meja terkait
        ->orderBy('booking_date', 'asc')
            ->orderBy('booking_time', 'asc')
            ->paginate(10); // Untuk pagination

        return view('backend.admin.reservations', compact('reservations'));
    }

    // Metode lain untuk admin, misal: konfirmasi, batalkan booking, dll.
    public function confirmBooking(Reservation $reservation)
    {
        $reservation->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi.');
    }

    public function cancelBooking(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
    }
}

