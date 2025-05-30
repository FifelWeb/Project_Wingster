{{-- resources/views/frontend/content/home.blade.php --}}

{{-- Menggunakan layout utama untuk frontend --}}
@extends('frontend.layout.main')

{{-- Menentukan judul halaman --}}
@section('title', 'Home - Wingster')

{{-- Bagian konten utama halaman home --}}
@section('content')
    <style>
        /* Styling khusus untuk halaman home ini */
        /* Pastikan styling ini tidak bentrok dengan CSS di layout utama Anda */

        /* Bagian Hero Section (Sambutan Utama) */
        .hero-section {
            background-color: #f8f8f8; /* Warna latar belakang lembut */
            padding: 60px 20px; /* Padding atas-bawah dan samping */
            text-align: center; /* Teks rata tengah */
            border-bottom: 1px solid #eee; /* Garis bawah pemisah */
        }
        .hero-section h1 {
            font-family: 'Montserrat', sans-serif; /* Contoh font elegan */
            font-size: 3.5em; /* Ukuran judul besar */
            color: #333; /* Warna teks gelap */
            margin-bottom: 15px; /* Jarak bawah judul */
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05); /* Sedikit bayangan teks */
        }
        .hero-section p {
            font-family: 'Open Sans', sans-serif; /* Contoh font body */
            font-size: 1.2em; /* Ukuran font deskripsi */
            color: #666; /* Warna teks abu-abu */
            max-width: 700px; /* Lebar maksimal paragraf */
            margin: 0 auto; /* Pusatkan paragraf */
            line-height: 1.6; /* Tinggi baris untuk keterbacaan */
        }

        /* Bagian Menu Section */
        .menu-section {
            padding: 50px 20px; /* Padding atas-bawah dan samping */
            max-width: 1200px; /* Lebar maksimal keseluruhan section agar tidak terlalu melebar */
            margin: 0 auto; /* Pusatkan section */
        }
        .menu-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.8em; /* Ukuran judul bagian */
            color: #333; /* Warna teks gelap */
            text-align: center; /* Rata tengah */
            margin-bottom: 40px; /* Jarak bawah judul */
            position: relative; /* Diperlukan untuk pseudo-elemen ::after */
        }
        /* Garis dekoratif di bawah judul bagian */
        .menu-section h2::after {
            content: ''; /* Konten kosong */
            display: block; /* Elemen blok */
            width: 80px; /* Lebar garis */
            height: 4px; /* Ketebalan garis */
            background-color: #FFD700; /* Warna aksen (misal: emas) */
            margin: 15px auto 0; /* Pusatkan garis dan beri jarak atas */
            border-radius: 2px; /* Sudut melengkung */
        }

        /* Grid untuk Item Menu */
        .menu-grid {
            display: grid;
            /* Default: 3 kolom di layar lebar */
            grid-template-columns: repeat(3, 1fr);
            gap: 30px; /* Jarak antar item */
            max-width: 1000px; /* Batasi lebar container grid untuk 3 kolom agar rapi */
            margin: 0 auto; /* Pusatkan grid */
        }

        /* Styling untuk Setiap Item Menu (Kartu) */
        .menu-item {
            background-color: #ffffff; /* Latar belakang putih */
            border-radius: 12px; /* Sudut lebih melengkung */
            overflow: hidden; /* Pastikan konten tidak keluar dari sudut melengkung */
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); /* Bayangan lembut */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Transisi halus saat hover */
            display: flex; /* Menggunakan flexbox untuk tata letak internal */
            flex-direction: column; /* Konten diatur dalam kolom */
        }
        .menu-item:hover {
            transform: translateY(-8px); /* Efek mengangkat saat dihover */
            box-shadow: 0 8px 25px rgba(0,0,0,0.15); /* Bayangan lebih kuat saat dihover */
        }
        .menu-item img {
            width: 100%; /* Lebar gambar penuh */
            height: 220px; /* Tinggi gambar tetap */
            object-fit: cover; /* Pastikan gambar mengisi area tanpa terdistorsi */
            display: block; /* Menghilangkan spasi ekstra di bawah gambar */
            border-bottom: 1px solid #f0f0f0; /* Garis tipis di bawah gambar */
        }
        .menu-item-content {
            padding: 20px; /* Padding di dalam konten kartu */
            flex-grow: 1; /* Konten akan mengisi sisa ruang vertikal */
            display: flex;
            flex-direction: column;
        }
        .menu-item h3 {
            font-family: 'Montserrat', sans-serif;
            margin-top: 0; /* Menghilangkan margin atas default */
            margin-bottom: 10px; /* Jarak bawah judul menu */
            color: #333; /* Warna judul menu */
            font-size: 1.6em; /* Ukuran font judul menu */
            font-weight: 600; /* Tebal */
        }
        .menu-item p {
            font-family: 'Open Sans', sans-serif;
            color: #777; /* Warna teks deskripsi */
            font-size: 0.95em; /* Ukuran font deskripsi */
            line-height: 1.6; /* Tinggi baris */
            min-height: 75px; /* Tinggi minimal untuk deskripsi agar kartu seragam */
            flex-grow: 1; /* Deskripsi akan mengisi ruang sebelum harga */
            margin-bottom: 15px; /* Jarak bawah deskripsi */
        }
        .menu-item .harga {
            font-family: 'Montserrat', sans-serif;
            display: block; /* Sebagai blok agar bisa rata kanan */
            margin-top: auto; /* Mendorong harga ke bagian bawah kartu */
            font-weight: bold; /* Tebal */
            color: #FF6347; /* Warna aksen untuk harga (merah tomat) */
            font-size: 1.4em; /* Ukuran font harga lebih besar */
            text-align: right; /* Harga rata kanan */
        }

        /* Pesan Jika Menu Kosong */
        .empty-menu-message {
            text-align: center; /* Rata tengah */
            padding: 50px; /* Padding */
            font-size: 1.2em; /* Ukuran font */
            color: #888; /* Warna teks */
            background-color: #f0f0f0; /* Latar belakang abu-abu muda */
            border-radius: 8px; /* Sudut melengkung */
            margin-top: 30px; /* Jarak atas */
        }

        /* Styling Tombol "Lihat Semua Menu" */
        .view-all-button-container {
            text-align: center;
            margin-top: 40px;
        }
        .view-all-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4CAF50; /* Warna hijau */
            color: white;
            text-decoration: none; /* Hapus garis bawah link */
            border-radius: 8px; /* Sudut melengkung */
            font-size: 1.1em;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Transisi halus */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Bayangan */
        }
        .view-all-button:hover {
            background-color: #45a049; /* Warna hijau lebih gelap saat hover */
            transform: translateY(-2px); /* Efek mengangkat sedikit */
        }


        /* MEDIA QUERIES UNTUK RESPONSIVITAS */

        /* Untuk Tablet (lebar kurang dari 992px, akan menjadi 2 kolom) */
        @media (max-width: 991px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom di tablet */
                max-width: 700px; /* Sesuaikan lebar untuk 2 kolom */
            }
        }

        /* Untuk Ponsel (lebar kurang dari 768px, akan menjadi 1 kolom) */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5em; /* Ukuran judul lebih kecil */
            }
            .hero-section p {
                font-size: 1em; /* Ukuran deskripsi lebih kecil */
            }
            .menu-section h2 {
                font-size: 2em; /* Ukuran judul bagian lebih kecil */
            }
            .menu-item img {
                height: 180px; /* Tinggi gambar lebih kecil */
            }
            .menu-grid {
                grid-template-columns: 1fr; /* 1 kolom di ponsel */
                max-width: 100%; /* Lebar penuh */
            }
            .menu-item-content {
                padding: 15px; /* Padding konten kartu lebih kecil */
            }
            .menu-item h3 {
                font-size: 1.4em; /* Ukuran judul menu lebih kecil */
            }
            .menu-item p {
                min-height: unset; /* Hapus min-height pada mobile agar deskripsi tidak terpotong */
            }
        }

        /* Untuk ponsel sangat kecil (kurang dari 480px, jika perlu penyesuaian ekstra) */
        @media (max-width: 480px) {
            /* Tambahkan penyesuaian khusus jika diperlukan */
        }
    </style>

    {{-- Bagian Hero Section --}}
    <div class="hero-section">
        <h1>Selamat Datang di Restoran Wingster!</h1>
        <p>Nikmati pengalaman kuliner terbaik dengan beragam hidangan lezat kami, mulai dari sayap ayam renyah hingga makanan pembuka yang menggoda selera. Siap memanjakan lidah Anda!</p>
    </div>

    {{-- Bagian Menu Makanan --}}
    <div class="menu-section">
        <h2>Menu Makanan Kami</h2>

        {{-- Kondisi jika tidak ada menu yang tersedia --}}
        @if($limitedMenus->isEmpty())
            <div class="empty-menu-message">
                <p>Maaf, belum ada menu spesial yang tersedia saat ini. Silakan kunjungi kembali nanti!</p>
            </div>
        @else
            {{-- Tampilan Grid Menu --}}
            <div class="menu-grid">
                {{-- Loop untuk setiap item menu yang diambil dari controller --}}
                @foreach($limitedMenus as $menu)
                    <div class="menu-item" data-menu-id="{{ $menu->id }}"> {{-- Tambahkan ini --}}
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name_menu }}">
                        <div class="menu-item-content">
                            <h3>{{ $menu->name_menu }}</h3>
                            <p>{{ $menu->decription }}</p>
                            <span class="harga">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Tombol "Lihat Semua Menu" (Opsional) --}}
        {{-- Tampilkan tombol hanya jika ada menu yang ditampilkan dan jumlahnya sama dengan batasan (misal: 6) --}}
        @if(!$limitedMenus->isEmpty() && $limitedMenus->count() == 6)
            <div class="view-all-button-container">
                <a href="{{ route('all.menus') }}" class="view-all-button">Lihat Semua Menu</a>
            </div>
        @endif
    </div>

    {{--Detail Menu--}}
    {{-- ... (kode HTML dan CSS Anda yang sudah ada) ... --}}

    <div id="menuDetailModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div class="modal-body">
                <img id="modalMenuImage" src="" alt="Menu Image" class="modal-image">
                <h2 id="modalMenuName"></h2>
                <p id="modalMenuDescription"></p>
                <p class="modal-price">Harga: <span id="modalMenuPrice"></span></p>
                {{-- Tambahkan tombol atau info lain jika diperlukan --}}
                {{-- <button class="add-to-cart-button">Tambah ke Keranjang</button> --}}
            </div>
        </div>
    </div>

    <style>
        /* CSS untuk Modal */
        .modal {
            display: none; /* Sembunyikan secara default */
            position: fixed; /* Tetap di viewport saat scroll */
            z-index: 1000; /* Letakkan di atas semua elemen lain */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Aktifkan scroll jika konten terlalu panjang */
            background-color: rgba(0,0,0,0.7); /* Latar belakang hitam transparan */
            justify-content: center; /* Pusatkan secara horizontal */
            align-items: center; /* Pusatkan secara vertikal */
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

        /* Media query untuk modal pada layar kecil */
        @media (max-width: 768px) {
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
    </style>

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
                            modalMenuDescription.textContent = data.description;
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
