@extends('frontend.layout.main')
@section('title', 'Keranjang Belanja')
@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">Keranjang Belanja Anda</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session()->has('pesan'))
            <div class="alert alert-{{ session('pesan')[0] }}">
                {{ session('pesan')[1] }}
            </div>
        @endif
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

        @if(empty($cartItems))
            <div class="alert alert-info text-center">Keranjang Anda kosong. Silakan <a href="{{ route('all.menus') }}">jelajahi menu</a> kami!</div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="list-group">
                        @foreach($cartItems as $item)
                            <div class="list-group-item d-flex align-items-center mb-3 p-3 shadow-sm rounded-lg">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">{{ $item['name'] }}</h5>
                                    <p class="mb-1 text-muted">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                    <div class="d-flex align-items-center">
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline quantity-form">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $item['id'] }}">
                                            <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity" data-id="{{ $item['id'] }}">-</button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center mx-1" style="width: 60px; display: inline-block;">
                                            <button type="button" class="btn btn-sm btn-outline-secondary increase-quantity" data-id="{{ $item['id'] }}">+</button>
                                        </form>
                                        {{-- MODIFIED DELETE FORM --}}
                                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline ms-3" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?');">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $item['id'] }}">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                <span class="fw-bold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm p-4">
                        <h4 class="mb-3">Ringkasan Pesanan</h4>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Item:
                                <span class="badge bg-primary rounded-pill">{{ count($cartItems) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total Belanja:
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <a href="{{ route('checkout.show') }}" class="btn btn-primary btn-lg w-100">Lanjutkan ke Pembayaran</a>
                        <a href="{{ route('all.menus') }}" class="btn btn-outline-secondary w-100 mt-2">Lanjutkan Belanja</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-form').forEach(form => {
                const menuId = form.querySelector('input[name="menu_id"]').value;
                const quantityInput = form.querySelector('input[name="quantity"]');

                form.querySelector('.increase-quantity').addEventListener('click', function() {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    updateCart(menuId, quantityInput.value);
                });

                form.querySelector('.decrease-quantity').addEventListener('click', function() {
                    if (parseInt(quantityInput.value) > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                        updateCart(menuId, quantityInput.value);
                    } else {
                        // If quantity becomes 0, ask for confirmation to remove the item
                        // Now using the same confirmation as the "Hapus" button directly
                        if (confirm('Anda yakin ingin menghapus item ini dari keranjang?')) {
                            // Find the corresponding remove form and submit it
                            form.closest('.d-flex').querySelector('form[action*="remove"]').submit();
                        }
                    }
                });

                quantityInput.addEventListener('change', function() {
                    if (parseInt(this.value) < 1) {
                        this.value = 1; // Minimal 1
                        // If quantity becomes less than 1, ask for confirmation to remove
                        if (confirm('Anda yakin ingin menghapus item ini dari keranjang?')) {
                            form.closest('.d-flex').querySelector('form[action*="remove"]').submit();
                        } else {
                            this.value = 1; // Revert to 1 if canceled
                        }
                    }
                    updateCart(menuId, this.value);
                });
            });

            function updateCart(menuId, quantity) {
                fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ menu_id: menuId, quantity: quantity })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                        // Reload halaman atau update UI secara dinamis
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memperbarui keranjang.');
                        window.location.reload(); // Fallback: reload jika error
                    });
            }
        });
    </script>
@endsection
