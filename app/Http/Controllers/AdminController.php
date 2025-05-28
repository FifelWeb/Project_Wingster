<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

// app/Http/Controllers/AdminController.php
class AdminController extends Controller
{
    public function reservations()
    {
        $reservations = Reservation::with('user', 'table')->get();
        return view('admin.reservations', compact('reservations'));
    }

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'confirmed';
        $reservation->save();

        return back()->with('success', 'Reservasi telah dikonfirmasi.');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->save();

        return back()->with('success', 'Reservasi telah ditolak.');
    }
}

