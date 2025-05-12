@extends('layouts.main')

@section('title', 'Daftar Menu')

@section('content')
    <section class="content">
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session('pesan')[0] }}">
                {{ session('pesan')[1] }}
            </div>
        @endif

        <div class="mb-3">
            <div class="col d-flex justify-content-between align-items-center">
                <h1 class="h3 text-gray-800 mb-0">List Menu</h1>
                <a href="{{ route('menu.add') }}" class="btn btn-sm btn-primary">Tambah Menu</a>
            </div>
        </div>

            <div class="card">
                <div class="card-body">
                <table class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $menu->name_menu }}</td>
                                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                <td>{{ $menu->category->name_category }}</td>
                                <td>
                                    @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" width="80">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('menu.delete', $menu->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus menu ini?')" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </table>
            </div>
            </div>
    </section>
@endsection
