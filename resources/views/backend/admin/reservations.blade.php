{{-- resources/views/backend/admin/reservations.blade.php --}}
@extends('layouts.main') {{-- Sesuaikan dengan layout admin Anda --}}
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Booking Meja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Dashboard Admin</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('email_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('email_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('email_warning'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('email_warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <h3>Daftar Booking Meja</h3>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pemesan</th>
            <th>Meja</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Jumlah Tamu</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->customer_name }}</td>
                <td>{{ $reservation->table->nomor_meja ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->booking_date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</td>
                <td>{{ $reservation->number_of_guests }}</td>
                <td>
                            <span class="badge {{
                                    $reservation->status == 'pending' ? 'bg-warning' :
                                    ($reservation->status == 'confirmed' ? 'bg-success' : 'bg-danger')
                                }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                </td>
                <td>
                    @if ($reservation->status == 'pending')
                        <form action="{{ route('admin.reservations.confirm', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm me-1">Konfirmasi</button>
                        </form>
                        <form action="{{ route('admin.reservations.cancel', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                        </form>
                    @else
                        {{-- Tambahkan tombol Hapus untuk status 'confirmed' atau 'cancelled' --}}
                        @if ($reservation->status == 'confirmed' || $reservation->status == 'cancelled')
                            <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE') {{-- Gunakan metode DELETE --}}
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @else
                            -
                        @endif
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada booking meja.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $reservations->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
