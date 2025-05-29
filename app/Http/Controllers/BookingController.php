<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

// Asumsi Anda punya model Reservation/Booking

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
            'nomor_meja' => 'required|exists:tables,id', // Ganti 'mejas' jika tabelnya 'tables'
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required|date_format:H:i', // Asumsi ada input jam booking
            'nama_pemesan' => 'required|string|max:255', // Asumsi ada input nama pemesan
            'jumlah_orang' => 'required|integer|min:1', // Asumsi ada input jumlah orang
            // Tambahkan validasi lain sesuai kebutuhan form Anda
        ]);

        try {
            // Asumsi Anda punya model Reservation (atau Booking) untuk menyimpan booking
            // Pastikan tabel 'reservations' ada dan memiliki kolom yang sesuai
            Reservation::create([
                'user_id' => auth()->id() ?? null, // Jika user login, simpan IDnya, jika tidak null
                'table_id' => $request->nomor_meja,
                'booking_date' => $request->tanggal_booking,
                'booking_time' => $request->jam_booking,
                'customer_name' => $request->nama_pemesan, // Contoh kolom
                'number_of_guests' => $request->jumlah_orang, // Contoh kolom
                'status' => 'pending', // Status awal: pending, confirmed, cancelled
                // Tambahkan kolom lain sesuai kebutuhan Anda
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Booking meja berhasil! Menunggu konfirmasi admin.');

        } catch (\Exception $e) {
            // Tangani error jika ada
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat booking: ' . $e->getMessage());
        }
    }
}

/*class BookingController extends Controller
{
    public function index()
    {
        // Ambil semua meja yang tersedia dari database
        // Anda bisa menambahkan kondisi seperti ->where('tersedia', true) jika diperlukan
        $table = Table::orderBy('nomor_meja')->get(); // Mengurutkan berdasarkan nomor meja

        return view('frontend.booking.index', compact('table')); // Mengirim data meja ke view 'booking'
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan booking
        // dd($request->all()); // Untuk melihat data yang dikirim dari form

        $request->validate([
            'nomor_meja' => 'required|exists:tables,id', // Pastikan ID meja ada di tabel mejas
            'tanggal_booking' => 'required|date|after_or_equal:today',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // ... logika penyimpanan booking ke database (misal tabel bookings) ...

        return redirect()->back()->with('success', 'Meja berhasil dibooking!');
    }
}*/

