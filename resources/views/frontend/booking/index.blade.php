{{-- resources/views/frontend/pages/booking/index.blade.php --}}

@extends('frontend.layout.main')

@section('title', 'Reservasi Meja - Wingster')

@section('content')

    {{-- Header Section untuk Halaman Booking --}}
    <header class="booking-page-header">
        <div class="container px-5">
            <h1 class="mb-3">Pesan Meja Anda</h1>
            <p class="lead">Nikmati pengalaman bersantap yang nyaman dengan reservasi meja di Wingster. Isi detail Anda di bawah ini.</p>
        </div>
    </header>

    {{-- Main Booking Form Section --}}
    <section class="booking-form-section">
        <div class="container px-5">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-7 col-xl-6"> {{-- Lebar kolom yang sedikit lebih lebar --}}
                    <div class="card booking-card"> {{-- Tambahkan kelas booking-card --}}
                        <div class="card-body p-4 p-md-5"> {{-- Padding yang lebih adaptif --}}
                            <h2 class="card-title text-center mb-5">Form Reservasi Meja</h2> {{-- Margin bawah yang lebih besar --}}

                            {{-- Pesan Sukses/Error --}}
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

                            <form action="{{ route('booking.store') }}" method="POST">
                                @csrf

                                {{-- Nama Pemesan --}}
                                <div class="mb-4"> {{-- Menggunakan mb-4 untuk margin-bottom yang lebih besar --}}
                                    <label for="nama_pemesan" class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan" name="nama_pemesan" required value="{{ old('nama_pemesan') }}" placeholder="Masukkan nama lengkap Anda">
                                    @error('nama_pemesan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{-- Pilih Meja --}}
                                <div class="mb-4">
                                    <label for="nomor_meja" class="form-label">Pilih Meja <span class="text-danger">*</span></label>
                                    <select class="form-select @error('nomor_meja') is-invalid @enderror" id="nomor_meja" name="nomor_meja" required>
                                        <option value="">-- Pilih Meja --</option>
                                        @foreach($tables as $table)
                                            <option value="{{ $table->id }}" {{ old('nomor_meja') == $table->id ? 'selected' : '' }}>
                                                {{ $table->nomor_meja }} (Kapasitas: {{ $table->kapasitas }} orang)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nomor_meja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{-- Tanggal Booking --}}
                                <div class="mb-4">
                                    <label for="tanggal_booking" class="form-label">Tanggal Booking <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_booking') is-invalid @enderror" id="tanggal_booking" name="tanggal_booking" required value="{{ old('tanggal_booking') }}">
                                    @error('tanggal_booking')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{-- Jam Booking --}}
                                <div class="mb-4">
                                    <label for="jam_booking" class="form-label">Jam Booking <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_booking') is-invalid @enderror" id="jam_booking" name="jam_booking" required value="{{ old('jam_booking') }}">
                                    @error('jam_booking')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{-- Jumlah Tamu --}}
                                <div class="mb-4">
                                    <label for="jumlah_orang" class="form-label">Jumlah Tamu <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" id="jumlah_orang" name="jumlah_orang" required min="1" value="{{ old('jumlah_orang', 1) }}" placeholder="Jumlah orang yang akan datang">
                                    @error('jumlah_orang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                {{-- Email Anda --}}
                                <div class="mb-5"> {{-- Margin bawah yang lebih besar sebelum tombol --}}
                                    <label for="customer_email" class="form-label">Email Anda <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" required value="{{ old('customer_email') }}" placeholder="Masukkan email Anda">
                                    @error('customer_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="d-grid"> {{-- Tombol full-width --}}
                                    <button type="submit" class="btn btn-primary btn-lg">Booking Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
