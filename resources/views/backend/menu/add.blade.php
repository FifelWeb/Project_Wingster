@extends('layouts.main')

@section('title', 'Tambah Menu')

@section('content')
    <section class="content">
        <h1 class="h3 mb-3">Form Tambah Menu</h1>

        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name_menu">Nama Menu</label>
                <input type="text" name="name_menu" class="form-control" value="{{ old('name_menu') }}">
            </div>

            <div class="mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control">
                    <option disabled selected>Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image">Gambar</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </section>
@endsection
