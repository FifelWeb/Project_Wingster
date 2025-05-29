@extends('layouts.main')
@section('content')
    <section>
        <table>
            <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Meja</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $res)
                <tr>
                    <td>{{ $res->user->name }}</td>
                    <td>{{ $res->table->table_number }}</td>
                    <td>{{ $res->booking_time }}</td>
                    <td>{{ $res->status }}</td>
                    <td>
                        @if ($res->status == 'pending')
                            <form method="POST" action="{{ route('admin.confirm', $res->id) }}">
                                @csrf
                                <button type="submit">Konfirmasi</button>
                            </form>
                            <form method="POST" action="{{ route('admin.reject', $res->id) }}">
                                @csrf
                                <button type="submit">Tolak</button>
                            </form>
                        @else
                            {{ ucfirst($res->status) }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
