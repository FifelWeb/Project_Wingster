{{-- resources/views/frontend/pages/menu/all_menus.blade.php --}}

@extends('frontend.layout.main')

@section('title', 'Semua Menu - Wingster')

@section('content')
    <style>
        /* Gaya tambahan untuk halaman all menus, bisa dipindahkan ke custom-styles.css */
        .all-menus-header {
            background-color: #f8f8f8;
            padding: 80px 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .all-menus-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.8em;
            color: #333;
            margin-bottom: 20px;
        }
        .all-menus-header p {
            font-size: 1.3em;
            max-width: 800px;
            margin: 0 auto;
        }

        .menu-grid-all {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Adaptif, min 280px */
            gap: 30px;
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-item-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
        }
        .menu-item-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }
        .menu-item-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            border-bottom: 1px solid #f0f0f0;
        }
        .menu-item-card-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .menu-item-card h3 {
            font-family: 'Montserrat', sans-serif;
            margin-top: 0;
            margin-bottom: 12px;
            color: #333;
            font-size: 1.8em;
            font-weight: 700;
        }
        .menu-item-card p {
            font-family: 'Open Sans', sans-serif;
            color: #777;
            font-size: 1em;
            line-height: 1.7;
            min-height: 80px; /* Jaga tinggi deskripsi */
            flex-grow: 1;
            margin-bottom: 20px;
        }
        .menu-item-card .harga {
            font-family: 'Montserrat', sans-serif;
            display: block;
            margin-top: auto;
            font-weight: bold;
            color: #FF6347;
            font-size: 1.6em;
            text-align: right;
            margin-bottom: 20px; /* Jarak sebelum tombol */
        }
        .add-to-cart-btn {
            background-color: #4CAF50; /* Hijau */
            border-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1.1em;
            border-radius: 8px; /* Lebih kotak dari tombol hero */
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%; /* Lebar penuh */
        }
        .add-to-cart-btn:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        /* Notifikasi Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Di atas modal */
        }
        .toast-body {
            display: flex;
            align-items: center;
        }
        .toast-body i {
            margin-right: 10px;
            font-size: 1.5rem;
        }

        /* Modal Detail (dari home.blade.php) */
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

        /* Responsiveness untuk Modal */
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

    <header class="all-menus-header">
        <div class="container px-5">
            <h1>Semua Menu Wingster</h1>
            <p>Jelajahi beragam hidangan lezat kami yang siap memanjakan lidah Anda. Pilih favorit Anda dan pesan sekarang!</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container px-5">
            @if($menus->isEmpty())
                <div class="alert alert-info text-center">Belum ada menu yang tersedia saat ini.</div>
            @else
                <div class="menu-grid-all">
                    @foreach($menus as $menu)
                        <div class="menu-item-card" data-menu-id="{{ $menu->id }}"> {{-- Tambahkan data-menu-id --}}
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama_menu }}">
                            <div class="menu-item-card-content">
                                <h3 class="mb-2">{{ $menu->name_menu }}</h3>
                                <p class="mb-3">{{ $menu->description }}</p>
                                <span class="harga">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                <button type="button" class="btn add-to-cart-btn mt-auto" data-id="{{ $menu->id }}">
                                    <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Notifikasi Toast Container --}}
    <div class="toast-container">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="liveToast">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill"></i>
                    Menu berhasil ditambahkan ke keranjang!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>


    {{-- Modal Detail Menu (sama seperti di home.blade.php, bisa dipindahkan ke main.blade.php jika sering dipakai) --}}
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
            // --- Logika untuk Modal Detail Menu (dari home.blade.php) ---
            const menuCardsForModal = document.querySelectorAll('.menu-item-card'); // Ganti selector jika perlu
            const modal = document.getElementById('menuDetailModal');
            const closeButton = document.querySelector('.close-button');
            const modalMenuImage = document.getElementById('modalMenuImage');
            const modalMenuName = document.getElementById('modalMenuName');
            const modalMenuDescription = document.getElementById('modalMenuDescription');
            const modalMenuPrice = document.getElementById('modalMenuPrice');

            function openModal() {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }

            // Memastikan event listener hanya terpasang pada area yang bisa diklik untuk modal
            menuCardsForModal.forEach(card => {
                card.addEventListener('click', function(event) {
                    // Hanya buka modal jika klik BUKAN pada tombol "Tambah ke Keranjang"
                    if (!event.target.classList.contains('add-to-cart-btn') && !event.target.closest('.add-to-cart-btn')) {
                        const menuId = this.dataset.menuId;
                        fetch(`{{ url('/menu') }}/${menuId}/details`) // Pastikan rute ini ada di web.php
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                modalMenuImage.src = `{{ asset('storage') }}/${data.image}`;
                                modalMenuName.textContent = data.name_menu;
                                modalMenuDescription.textContent = data.description;
                                modalMenuPrice.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.price)}`;
                                openModal();
                            })
                            .catch(error => {
                                console.error('Error fetching menu details:', error);
                                alert('Gagal memuat detail menu. Silakan coba lagi.');
                            });
                    }
                });
            });

            closeButton.addEventListener('click', closeModal);
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            });
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.style.display === 'flex') {
                    closeModal();
                }
            });


            // --- Logika untuk Tambah ke Keranjang (AJAX) ---
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            const liveToast = new bootstrap.Toast(document.getElementById('liveToast')); // Inisialisasi Toast Bootstrap

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const menuId = this.dataset.id; // Ambil ID menu dari data-id tombol

                    fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Penting untuk Laravel
                        },
                        body: JSON.stringify({ menu_id: menuId, quantity: 1 }) // Default quantity 1
                    })
                        .then(response => {
                            if (!response.ok) {
                                // Tangani jika ada error dari server (misal validasi)
                                return response.json().then(err => Promise.reject(err));
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data.message);
                            // Tampilkan notifikasi Toast
                            liveToast.show();
                        })
                        .catch(error => {
                            console.error('Error adding to cart:', error);
                            let errorMessage = 'Gagal menambahkan menu ke keranjang.';
                            if (error.message) {
                                errorMessage += ' ' + error.message;
                            }
                            alert(errorMessage);
                        });
                });
            });
        });
    </script>
@endsection
