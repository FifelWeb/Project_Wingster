<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmedMail;
class AdminController extends Controller
{
    public function admin()
    {
        $reservations = Reservation::with('table')
        ->orderBy('booking_date', 'asc')
            ->orderBy('booking_time', 'asc')
            ->paginate(10);

        return view('backend.admin.reservations', compact('reservations'));
    }

    // Metode untuk konfirmasi booking
    public function confirmBooking(Reservation $reservation)
    {
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
                session()->flash('email_error', 'Email konfirmasi gagal terkirim kepada pelanggan.');
            }

        } else {
            \Log::warning('Kolom customer_email kosong untuk booking ID: ' . $reservation->id . '. Email konfirmasi tidak dapat dikirim.');

            session()->flash('email_warning', 'Email pelanggan tidak ditemukan, konfirmasi tidak terkirim via email.');
        }

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi dan notifikasi telah dikirim.');
    }

    // Metode untuk membatalkan booking
    public function cancelBooking(Reservation $reservation)
    {
        if ($reservation->status === 'cancelled') {
            return redirect()->back()->with('error', 'Booking sudah dibatalkan sebelumnya.');
        }

        $reservation->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
    }

    // --- METODE BARU UNTUK MENGELOLA PESANAN (ORDER) ---
    public function ordersIndex()
    {
        // Ambil semua pesanan, urutkan berdasarkan tanggal terbaru
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.admin.kelolaOrder', compact('orders'));
    }

    // Metode untuk memperbarui status pesanan (Order)
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,preparing,delivered,cancelled',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
    public function destroyBooking(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return redirect()->back()->with('success', 'Booking berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Gagal menghapus booking ID: ' . $reservation->id . '. Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus booking.');
        }
    }
}

