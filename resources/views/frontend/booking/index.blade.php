@extends('frontend.layout.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Pastikan Anda juga menampilkan validasi error di setiap input --}}
    {{-- Contoh:
        <input type="text" name="nama_pemesan" class="form-control">
        @error('nama_pemesan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    --}}

    <form action="{{ route('booking.store') }}" method="POST">
        <div class="form-group">
            <label for="nama_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required value="{{ old('nama_pemesan') }}">
            @error('nama_pemesan')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        <div class="form-group">
            <label for="nomor_meja">Pilih Meja</label>
            <select class="form-control" id="nomor_meja" name="nomor_meja" required>
                <option value="">-- Pilih Meja --</option>
                @foreach($tables as $table)
                    {{-- Gunakan $meja->id sebagai value dan $meja->nomor_meja sebagai teks yang ditampilkan --}}
                    <option value="{{ $table->id }}">{{ $table->nomor_meja }} (Kapasitas: {{ $table->kapasitas }})</option>
                @endforeach
            </select>
            @error('nomor_meja')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="tanggal_booking">Tanggal Booking</label>
            <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" required>
            @error('tanggal_booking')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="jam_booking">Jam Booking</label>
            <input type="time" class="form-control" id="jam_booking" name="jam_booking" required value="{{ old('jam_booking') }}">
            @error('jam_booking')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="jumlah_orang">Jumlah Tamu</label>
            <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required min="1" value="{{ old('jumlah_orang', 1) }}">
            @error('jumlah_orang')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tambahkan input lain jika ada (misal: jam booking, nama pelanggan, dll) --}}

        <button type="submit" class="btn btn-primary mt-4">Booking</button>
    </form>
@endsection
