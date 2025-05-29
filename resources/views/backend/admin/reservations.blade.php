@extends('layouts.main')
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
        <div class="alert alert-success">
            {{ session('success') }}
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
                <td>{{ $reservation->table->nomor_meja ?? 'N/A' }}</td> {{-- Mengambil nomor meja dari relasi --}}
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
                            <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                        </form>
                        <form action="{{ route('admin.reservations.cancel', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                        </form>
                    @else
                        -
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

    {{ $reservations->links() }} {{-- Untuk menampilkan pagination --}}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
