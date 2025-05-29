<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table; // Asumsi model meja Anda adalah Meja.php
use Illuminate\Support\Facades\Mail; // Import Mail Facade
use App\Mail\BookingConfirmedMail;
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

    // Metode untuk konfirmasi booking
    public function confirmBooking(Reservation $reservation)
    {
        // Periksa jika status saat ini bukan 'pending' untuk menghindari pengiriman email berulang atau aksi yang tidak perlu
        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'Booking sudah dikonfirmasi atau dibatalkan sebelumnya.');
        }

        // Update status booking menjadi 'confirmed'
        $reservation->update(['status' => 'confirmed']);
        if ($reservation->customer_email) {
            try {
                // Kirim email menggunakan Mailable BookingConfirmedMail
                Mail::to($reservation->customer_email)->send(new BookingConfirmedMail($reservation));
                \Log::info('Email konfirmasi booking terkirim ke: ' . $reservation->customer_email . ' untuk booking ID: ' . $reservation->id);
            } catch (\Exception $e) {

                // Tangani error jika pengiriman email gagal
                \Log::error('Gagal mengirim email konfirmasi booking untuk ID: ' . $reservation->id . '. Error: ' . $e->getMessage() . ' pada ' . $e->getFile() . ' baris ' . $e->getLine());
                // Opsional: Anda bisa tambahkan pesan error ke sesi untuk admin
                session()->flash('email_error', 'Email konfirmasi gagal terkirim kepada pelanggan.');
            }

        } else {
            \Log::warning('Kolom customer_email kosong untuk booking ID: ' . $reservation->id . '. Email konfirmasi tidak dapat dikirim.');
            // Opsional: Anda bisa tambahkan pesan peringatan ke sesi
            session()->flash('email_warning', 'Email pelanggan tidak ditemukan, konfirmasi tidak terkirim via email.');
        }
        // --- Akhir Logika Pengiriman Email ---

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi dan notifikasi telah dikirim.');
    }

    // Metode untuk membatalkan booking
    public function cancelBooking(Reservation $reservation)
    {
        // Anda bisa tambahkan pengecekan status di sini juga jika perlu
        if ($reservation->status === 'cancelled') {
            return redirect()->back()->with('error', 'Booking sudah dibatalkan sebelumnya.');
        }

        $reservation->update(['status' => 'cancelled']);
        // Anda bisa tambahkan logika pengiriman email pembatalan juga di sini jika diinginkan
        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
    }
}

