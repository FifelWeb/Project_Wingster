{{-- resources/views/frontend/content/contact.blade.php --}}

@extends('frontend.layout.main')

@section('title', 'Hubungi Kami - Wingster')

@section('content')
    <style>
        /* Styling Umum untuk Halaman About dan Contact (sama dengan about.blade.php) */
        .page-header {
            background-color: #f8f8f8;
            padding: 60px 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .page-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5em;
            color: #333;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }
        .page-header p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.2em;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .page-content-section {
            padding: 50px 20px;
            max-width: 960px;
            margin: 0 auto;
            font-family: 'Open Sans', sans-serif;
            color: #444;
            line-height: 1.8;
        }
        .page-content-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2em;
            color: #333;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }
        .page-content-section h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #FFD700;
            margin: 15px auto 0;
            border-radius: 2px;
        }
        .page-content-section p {
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        /* Styling Tambahan untuk Form Kontak */
        .contact-info {
            text-align: center;
            margin-bottom: 40px;
        }
        .contact-info p {
            font-size: 1.15em;
            margin-bottom: 10px;
        }
        .contact-info a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .contact-info a:hover {
            color: #45a049;
        }
        .contact-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: 0 auto;
        }
        .contact-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: calc(100% - 20px); /* Kurangi padding */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            font-family: 'Open Sans', sans-serif;
        }
        .contact-form textarea {
            resize: vertical; /* Izinkan user mengubah tinggi textarea */
            min-height: 120px;
        }
        .contact-form button {
            display: block;
            width: 100%;
            padding: 12px 20px;
            background-color: #FF6347; /* Warna tombol */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-form button:hover {
            background-color: #e55338;
        }

        /* Media Queries untuk responsivitas */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.8em;
            }
            .page-header p {
                font-size: 1em;
            }
            .page-content-section h2 {
                font-size: 1.8em;
            }
            .page-content-section p {
                font-size: 1em;
            }
            .page-content-section {
                padding: 30px 15px;
            }
            .contact-form {
                padding: 20px;
            }
            .contact-form input[type="text"],
            .contact-form input[type="email"],
            .contact-form textarea {
                width: calc(100% - 16px); /* Sesuaikan padding */
                padding: 8px;
            }
        }
    </style>

    <div class="page-header">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda! Jangan ragu untuk menghubungi kami melalui informasi di bawah ini atau formulir kontak.</p>
    </div>

    <div class="page-content-section">
        <h2>Informasi Kontak</h2>
        <div class="contact-info">
            <p><strong>Alamat:</strong> Jl. Contoh Alamat No. 123, Kota Anda, Kode Pos 12345</p>
            <p><strong>Telepon:</strong> <a href="tel:+6281234567890">+62 812-3456-7890</a></p>
            <p><strong>Email:</strong> <a href="mailto:info@wingster.com">info@wingster.com</a></p>
            <p><strong>Jam Operasional:</strong> Setiap Hari, 10:00 - 22:00 WIB</p>
        </div>
    </div>

    <div class="contact-form">
        <form action="{{ route('contact.submit') }}" method="POST"> {{-- UBAH DI SINI --}}
            @csrf {{-- Penting! Ini untuk keamanan CSRF Laravel --}}
            <label for="name">Nama Lengkap:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Anda:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subjek:</label>
            <input type="text" id="subject" name="subject">

            <label for="message">Pesan Anda:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Kirim Pesan</button>
        </form>
    </div>

    {{-- Untuk menampilkan pesan sukses/error setelah form disubmit --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; padding: 15px; margin-top: 20px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; padding: 15px; margin-top: 20px; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Menampilkan error validasi (jika ada) --}}
    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; padding: 15px; margin-top: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
