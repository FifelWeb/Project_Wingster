<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('nomor_meja')->get();
        return view('frontend.booking.index', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|exists:tables,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required|date_format:H:i',
            'nama_pemesan' => 'required|string|max:255',
            'jumlah_orang' => 'required|integer|min:1',
            'customer_email' => 'required|email|max:255',
        ]);

        try {
            Reservation::create([
                'user_id' => auth()->id() ?? null,
                'table_id' => $request->nomor_meja,
                'booking_date' => $request->tanggal_booking,
                'booking_time' => $request->jam_booking,
                'customer_name' => $request->nama_pemesan,
                'number_of_guests' => $request->jumlah_orang,
                'customer_email' => $request->customer_email,
                'status' => 'pending',
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Booking meja berhasil! Menunggu konfirmasi admin.');

        } catch (\Exception $e) {
            // Tangani error jika ada
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat booking: ' . $e->getMessage());
        }
    }
}

