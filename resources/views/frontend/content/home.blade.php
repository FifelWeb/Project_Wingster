{{-- resources/views/frontend/content/home.blade.php --}}

@extends('frontend.layout.main')

@section('title', 'Home - Wingster')

@section('content')
    <style>
        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets-fe/assets/hero-bg.jpg') }}') no-repeat center center; /* Ganti dengan gambar latar belakang Anda */
            background-size: cover;
            color: white;
            padding: 120px 20px; /* Padding lebih besar untuk kesan grand */
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Dark overlay */
            z-index: 1;
        }
        .hero-section > * {
            position: relative;
            z-index: 2;
        }
        .hero-section h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 4.5em; /* Ukuran font lebih besar */
            margin-bottom: 25px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            font-weight: 700;
        }
        .hero-section p {
            font-size: 1.4em;
            max-width: 800px;
            margin: 0 auto 40px auto;
            line-height: 1.8;
        }
        .hero-section .btn-hero {
            background-color: #FF6347; /* Warna aksen tombol */
            border-color: #FF6347;
            color: white;
            padding: 15px 35px;
            font-size: 1.2em;
            border-radius: 50px; /* Tombol bulat */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .hero-section .btn-hero:hover {
            background-color: #e55338;
            transform: translateY(-3px);
        }

        /* --- Section Title (Untuk "Menu Makanan Kami") --- */
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 3em;
            color: #333;
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            padding-top: 50px; /* Padding agar tidak terlalu mepet dengan section atas */
        }
        .section-title::after {
            content: '';
            display: block;
            width: 100px; /* Garis lebih panjang */
            height: 5px; /* Lebih tebal */
            background-color: #FFD700;
            margin: 15px auto 0;
            border-radius: 3px;
        }

        /* --- Menu Grid & Item --- */
        .menu-section {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Tetap 3 kolom untuk home */
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .menu-item {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1); /* Bayangan lebih dalam */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0; /* Border tipis */
        }
        .menu-item:hover {
            transform: translateY(-10px); /* Efek mengangkat lebih tinggi */
            box-shadow: 0 12px 30px rgba(0,0,0,0.2); /* Bayangan lebih kuat */
        }
        .menu-item img {
            width: 100%;
            height: 250px; /* Tinggi gambar sedikit lebih besar */
            object-fit: cover;
            display: block;
            border-bottom: 1px solid #f0f0f0;
        }
        .menu-item-content {
            padding: 25px; /* Padding lebih besar */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .menu-item h3 {
            font-family: 'Montserrat', sans-serif;
            margin-top: 0;
            margin-bottom: 12px;
            color: #333;
            font-size: 1.8em; /* Ukuran judul menu lebih besar */
            font-weight: 700;
        }
        .menu-item p {
            font-family: 'Open Sans', sans-serif;
            color: #777;
            font-size: 1em;
            line-height: 1.7;
            min-height: 80px; /* Sesuaikan atau hapus jika deskripsi sangat bervariasi */
            flex-grow: 1;
            margin-bottom: 20px;
        }
        .menu-item .harga {
            font-family: 'Montserrat', sans-serif;
            display: block;
            margin-top: auto;
            font-weight: bold;
            color: #FF6347;
            font-size: 1.6em; /* Ukuran font harga lebih besar */
            text-align: right;
        }

        /* --- View All Button --- */
        .view-all-button-container {
            text-align: center;
            margin-top: 50px;
        }
        .view-all-button {
            display: inline-block;
            padding: 15px 40px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 50px; /* Tombol bulat */
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .view-all-button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        /* --- Google Maps Section --- */
        .map-section {
            padding: 60px 0;
            background-color: #f0f0f0; /* Latar belakang section peta */
            text-align: center;
        }
        .map-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5em;
            color: #333;
            margin-bottom: 40px;
            position: relative;
        }
        .map-section h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background-color: #FF6347; /* Warna aksen yang berbeda untuk peta */
            margin: 15px auto 0;
            border-radius: 2px;
        }
        .map-container {
            max-width: 900px; /* Ukuran maksimum peta */
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden; /* Pastikan peta mengikuti border-radius */
            box-shadow: 0 8px 25px rgba(0,0,0,0.15); /* Bayangan pada peta */
        }
        .map-container iframe {
            width: 100%;
            height: 450px; /* Tinggi peta */
            display: block;
        }

        /* --- CSS untuk Modal --- */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Untuk pusatkan di browser lama */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 600px; /* Lebar maksimal modal */
            position: relative; /* Untuk tombol close */
            animation-name: animatetop;
            animation-duration: 0.4s;
        }
        /* Animasi muncul dari atas */
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }
        .close-button {
            color: #aaa;
            float: right; /* Posisikan di kanan atas */
            font-size: 36px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
        }
        .close-button:hover,
        .close-button:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-body {
            text-align: center;
            padding: 20px 0;
        }
        .modal-image {
            max-width: 100%;
            height: 250px; /* Tinggi gambar modal */
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        #modalMenuName {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2em;
            color: #333;
            margin-bottom: 10px;
        }
        #modalMenuDescription {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1em;
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .modal-price {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.6em;
            font-weight: bold;
            color: #FF6347;
        }

        /* --- Responsiveness (Tambahan dan Penyesuaian) --- */
        @media (max-width: 991px) { /* Tablet */
            .hero-section h1 {
                font-size: 3.5em;
            }
            .hero-section p {
                font-size: 1.2em;
            }
            .section-title {
                font-size: 2.5em;
            }
            .menu-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom di tablet */
                max-width: 700px;
            }
            .map-container iframe {
                height: 350px;
            }
            /* Modal */
            .modal-content {
                width: 90%;
            }
        }

        @media (max-width: 767px) { /* Ponsel */
            .hero-section {
                padding: 80px 15px;
            }
            .hero-section h1 {
                font-size: 2.8em;
            }
            .hero-section p {
                font-size: 1em;
            }
            .hero-section .btn-hero {
                padding: 12px 25px;
                font-size: 1.1em;
            }
            .section-title {
                font-size: 2em;
                margin-bottom: 30px;
            }
            .menu-grid {
                grid-template-columns: 1fr; /* 1 kolom di ponsel */
                max-width: 90%;
            }
            .menu-item img {
                height: 200px;
            }
            .menu-item h3 {
                font-size: 1.5em;
            }
            .menu-item p {
                min-height: unset; /* Lepaskan min-height untuk ponsel */
            }
            .menu-item .harga {
                font-size: 1.3em;
            }
            .view-all-button {
                padding: 12px 30px;
                font-size: 1.1em;
            }
            .map-section {
                padding: 40px 0;
            }
            .map-section h2 {
                font-size: 2em;
            }
            .map-container iframe {
                height: 300px;
            }
            /* Modal */
            .modal-content {
                width: 95%; /* Lebar modal lebih besar di ponsel */
                padding: 20px;
            }
            #modalMenuName {
                font-size: 1.8em;
            }
            #modalMenuDescription {
                font-size: 0.95em;
            }
            .modal-price {
                font-size: 1.3em;
            }
            .modal-image {
                height: 180px;
            }
        }

        /* Untuk ponsel sangat kecil (kurang dari 480px, jika perlu penyesuaian ekstra) */
        @media (max-width: 480px) {
            /* Tambahkan penyesuaian khusus jika diperlukan */
        }
    </style>

    {{-- Bagian Hero Section --}}
    <header class="hero-section">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Selamat Datang di Restoran Wingster!</h1>
                        <p class="lead fw-normal text-white-50 mb-4">Nikmati pengalaman kuliner terbaik dengan beragam hidangan lezat kami, mulai dari sayap ayam renyah hingga makanan pembuka yang menggoda selera. Siap memanjakan lidah Anda!</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3 btn-hero" href="{{ route('all.menus') }}">Lihat Semua Menu</a>
                            <a class="btn btn-outline-light btn-lg px-4 btn-hero" href="{{ route('booking.index') }}">Pesan Meja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Bagian Menu Makanan --}}
    <section class="menu-section py-5">
        <div class="container px-5 my-5">
            <h2 class="section-title">Menu Makanan Kami</h2>

            @if($limitedMenus->isEmpty())
                <div class="empty-menu-message">
                    <p>Maaf, belum ada menu spesial yang tersedia saat ini. Silakan kunjungi kembali nanti!</p>
                </div>
            @else
                <div class="menu-grid">
                    @foreach($limitedMenus as $menu)
                        <div class="menu-item" data-menu-id="{{ $menu->id }}">
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name_menu }}">
                            <div class="menu-item-content">
                                <h3>{{ $menu->name_menu }}</h3>
                                <p>{{ $menu->description }}</p>
                                <span class="harga">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(!$limitedMenus->isEmpty() && $limitedMenus->count() == 6)
                <div class="view-all-button-container">
                    <a href="{{ route('all.menus') }}" class="view-all-button">Lihat Semua Menu Lengkap</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Bagian Peta Google Maps --}}
    <section class="map-section">
        <div class="container px-5">
            <h2>Lokasi Kami</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.727960784663!2d110.
                59823469999999!3d-7.712312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a45b9dba934dd%3A0x409e300535a61ba8!2sWingster!5e0!3m2!1sen!2sid!4v1748580451066!5m2!1sen!2sid"
                        width="800"
                        height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <p class="lead mt-4 text-muted">Kunjungi kami untuk pengalaman bersantap yang tak terlupakan!</p>
        </div>
    </section>

    {{-- Bagian Modal Detail Menu --}}
    <div id="menuDetailModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div class="modal-body">
                <img id="modalMenuImage" src="" alt="Menu Image" class="modal-image">
                <h2 id="modalMenuName"></h2>
                <p id="modalMenuDescription"></p>
                <p class="modal-price">Harga: <span id="modalMenuPrice"></span></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            const modal = document.getElementById('menuDetailModal');
            const closeButton = document.querySelector('.close-button');
            const modalMenuImage = document.getElementById('modalMenuImage');
            const modalMenuName = document.getElementById('modalMenuName');
            const modalMenuDescription = document.getElementById('modalMenuDescription');
            const modalMenuPrice = document.getElementById('modalMenuPrice');

            // Fungsi untuk membuka modal
            function openModal() {
                modal.style.display = 'flex'; // Gunakan flex untuk pusatkan modal
                document.body.style.overflow = 'hidden'; // Nonaktifkan scroll body
            }

            // Fungsi untuk menutup modal
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = ''; // Aktifkan kembali scroll body
            }

            // Event listener untuk setiap item menu
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    const menuId = this.dataset.menuId; // Ambil ID menu dari data-id
                    const url = `{{ url('/menu') }}/${menuId}/details`; // Buat URL endpoint

                    // Lakukan AJAX request (fetch API)
                    fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Isi data ke dalam modal
                            modalMenuImage.src = `{{ asset('storage') }}/${data.image}`;
                            modalMenuName.textContent = data.name_menu;
                            modalMenuDescription.textContent = data.ddecription;
                            modalMenuPrice.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.price)}`;

                            openModal(); // Tampilkan modal
                        })
                        .catch(error => {
                            console.error('Error fetching menu details:', error);
                            alert('Gagal memuat detail menu. Silakan coba lagi.');
                        });
                });
            });

            // Event listener untuk tombol close
            closeButton.addEventListener('click', closeModal);

            // Event listener untuk menutup modal saat klik di luar area konten modal
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            });

            // Event listener untuk menutup modal saat tombol ESC ditekan
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.style.display === 'flex') {
                    closeModal();
                }
            });
        });
    </script>
@endsection
