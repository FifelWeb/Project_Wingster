{{-- resources/views/admin/orders/index.blade.php --}}
@extends('layouts.main') {{-- Assuming you have an admin layout --}}
@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manajemen Pesanan</h1>

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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Total</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>
                                    <span class="badge {{
                                        $order->status == 'pending' ? 'bg-warning' :
                                        ($order->status == 'confirmed' ? 'bg-info' :
                                        ($order->status == 'preparing' ? 'bg-primary' :
                                        ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')))
                                    }} text-white">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT') {{-- Use PUT method for updating resources --}}
                                        <select name="status" class="form-select form-select-sm d-inline-block" style="width: auto;">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Konfirmasi</option>
                                            <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Persiapan</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success mt-1">Update</button>
                                    </form>
                                    {{-- Optionally, add a button to view order details --}}
                                    {{-- <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info mt-1">Detail</a> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
