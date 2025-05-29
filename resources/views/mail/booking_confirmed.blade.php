<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Booking Meja</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
        h1 { color: #0056b3; }
        p { margin-bottom: 10px; }
        .details { background-color: #eee; padding: 15px; border-radius: 5px; margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>
<div class="container">
    <h1>Halo {{ $reservation->customer_name ?? 'Pelanggan' }},</h1>

    <p>Booking meja Anda di **{{ config('app.name') }}** telah berhasil dikonfirmasi!</p>

    <div class="details">
        <p><strong>Detail Booking:</strong></p>
        <p>Nomor Meja: <strong>{{ $reservation->table->nomor_meja ?? 'N/A' }}</strong></p>
        <p>Tanggal: <strong>{{ \Carbon\Carbon::parse($reservation->booking_date)->format('d M Y') }}</strong></p>
        <p>Jam: <strong>{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }} WIB</strong></p>
        <p>Jumlah Tamu: <strong>{{ $reservation->number_of_guests }} orang</strong></p>
        <p>Status: <strong>{{ ucfirst($reservation->status) }}</strong></p>
    </div>

    <p>Terima kasih telah memesan. Kami menantikan kedatangan Anda!</p>

    <div class="footer">
        <p>Hormat kami,</p>
        <p>Tim {{ config('app.name') }}</p>
    </div>
</div>
</body>
</html>
