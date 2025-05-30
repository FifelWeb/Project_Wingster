{{-- resources/views/frontend/content/all_menus.blade.php --}}

@extends('frontend.layout.main')

@section('title', 'Semua Menu - Wingster')

@section('content')
    <style>
        /* Styling dasar yang sama dengan home.blade.php untuk konsistensi */
        .menu-section {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .menu-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.8em;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .menu-section h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background-color: #FFD700;
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Grid untuk Semua Item Menu */
        .menu-grid {
            display: grid;
            /* Di sini Anda bisa tentukan berapa kolom yang Anda inginkan untuk 'semua menu' */
            /* Misalnya, 4 kolom di layar lebar agar lebih banyak menu terlihat */
            grid-template-columns: repeat(4, 1fr); /* 4 kolom */
            gap: 30px;
            max-width: 1200px; /* Lebar maksimal sesuai dengan 4 kolom */
            margin: 0 auto;
        }

        /* Styling untuk Setiap Item Menu (Kartu) - Sama dengan home.blade.php */
        .menu-item {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }
        .menu-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .menu-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            border-bottom: 1px solid #f0f0f0;
        }
        .menu-item-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .menu-item h3 {
            font-family: 'Montserrat', sans-serif;
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
            font-size: 1.6em;
            font-weight: 600;
        }
        .menu-item p {
            font-family: 'Open Sans', sans-serif;
            color: #777;
            font-size: 0.95em;
            line-height: 1.6;
            min-height: 75px; /* Pertahankan ini agar kartu memiliki tinggi yang relatif sama */
            flex-grow: 1;
            margin-bottom: 15px;
        }
        .menu-item .harga {
            font-family: 'Montserrat', sans-serif;
            display: block;
            margin-top: auto;
            font-weight: bold;
            color: #FF6347;
            font-size: 1.4em;
            text-align: right;
        }

        .empty-menu-message {
            text-align: center;
            padding: 50px;
            font-size: 1.2em;
            color: #888;
            background-color: #f0f0f0;
            border-radius: 8px;
            margin-top: 30px;
        }

        /* MEDIA QUERIES UNTUK RESPONSIVITAS PADA ALL_MENUS.BLADE.PHP */
        /* Mungkin ingin tetap 3 kolom di tablet, dan 2 kolom di ponsel */
        @media (max-width: 1199px) { /* Untuk layar di bawah 1200px (misal: laptop kecil), bisa jadi 3 kolom */
            .menu-grid {
                grid-template-columns: repeat(3, 1fr);
                max-width: 1000px;
            }
        }

        @media (max-width: 991px) { /* Untuk tablet, menjadi 2 kolom */
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
                max-width: 700px;
            }
        }

        @media (max-width: 768px) { /* Untuk ponsel, menjadi 1 kolom */
            .menu-section h2 {
                font-size: 2em;
            }
            .menu-item img {
                height: 180px;
            }
            .menu-grid {
                grid-template-columns: 1fr;
                max-width: 100%;
            }
            .menu-item-content {
                padding: 15px;
            }
            .menu-item h3 {
                font-size: 1.4em;
            }
            .menu-item p {
                min-height: unset; /* Hapus min-height pada mobile */
            }
        }

    </style>

    {{-- Tidak ada Hero Section di halaman ini --}}
    <div class="menu-section">
        <h2>Daftar Lengkap Menu Kami</h2>

        {{-- Kondisi jika tidak ada menu sama sekali --}}
        @if($allMenus->isEmpty())
            <div class="empty-menu-message">
                <p>Maaf, belum ada menu yang tersedia saat ini.</p>
            </div>
        @else
            {{-- Tampilan Grid Menu --}}
            <div class="menu-grid">
                {{-- Loop untuk setiap item menu yang diambil dari controller (semua menu) --}}
                @foreach($allMenus as $menu)
                    <div class="menu-item">
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name_menu }}">
                        <div class="menu-item-content">
                            <h3>{{ $menu->name_menu }}</h3>
                            <p>{{ $menu->description }}</p>
                            <span class="harga">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Opsional: Jika Anda menggunakan pagination di controller, tampilkan di sini --}}
            {{-- {{ $allMenus->links() }} --}}
        @endif
    </div>

@endsection
