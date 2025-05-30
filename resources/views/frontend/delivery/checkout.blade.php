{{-- resources/views/frontend/delivery/checkout.blade.php --}}

@extends('frontend.layout.main') {{-- Adjust this to your actual frontend layout --}}

@section('title', 'Checkout - Wingster')

@section('content')
    <section class="checkout-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Form Pembayaran</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title mb-3">Detail Pesanan</h3>
                            <ul class="list-group mb-4">
                                @foreach($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            {{ $item['name'] }} (x{{ $item['quantity'] }})
                                            <br>
                                            <small>Rp {{ number_format($item['price_at_order'], 0, ',', '.') }}</small>
                                        </div>
                                        <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    <h4>Total:</h4>
                                    <h4>Rp {{ number_format($total, 0, ',', '.') }}</h4>
                                </li>
                            </ul>

                            <hr>

                            <h3 class="card-title mb-3">Informasi Pengiriman</h3>
                            <form action="{{ route('checkout.place') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required>
                                    @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="delivery_address" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control @error('delivery_address') is-invalid @enderror" id="delivery_address" name="delivery_address" rows="3" required>{{ old('delivery_address') }}</textarea>
                                    @error('delivery_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="customer_phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::user()->phone ?? '') }}" required>
                                    @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Metode pembayaran tetap sama --}}
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash On Delivery (COD)</option>
                                    </select>
                                    @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Pesan Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
