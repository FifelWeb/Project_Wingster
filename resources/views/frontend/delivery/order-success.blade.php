@extends('frontend.layout.main')

@section('title', 'Checkout - Wingster')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil!</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Adjust if your CSS path is different --}}
</head>
<body>
<div style="text-align: center; margin-top: 50px;">
    <h1>Pesanan Anda Berhasil Dibuat!</h1>
    <p>Terima kasih telah memesan. Pesanan Anda dengan kode **{{ $orderCode }}** telah berhasil dicatat.</p>
    <p>Kami akan segera memproses pesanan Anda.</p>
    <p><a href="{{ route('home.index') }}">Kembali ke Beranda</a></p>

    {{-- Optional: Display more order details --}}
    @if(isset($order))
        <h3>Detail Pesanan:</h3>
        <p>Nama Pelanggan: {{ $order->customer_name }}</p>
        <p>Alamat Pengiriman: {{ $order->delivery_address }}</p>
        <p>Total Jumlah: Rp {{ number_format($order->total_amount, 2, ',', '.') }}</p>
        <p>Status: {{ ucfirst($order->status) }}</p>
    @endif
</div>
</body>
</html>
@endsection
