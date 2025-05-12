@extends('layouts.main')

@section('title', 'Edit Menu')

@section('content')
    <section class="content">
        <h1 class="h3 mb-3">Form Edit Menu</h1>

        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="name_menu">Nama Menu</label>
                <input type="text" name="name_menu" class="form-control" value="{{ old('name_menu', $menu->name_menu) }}">
            </div>

            <div class="mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $menu->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $menu->price) }}">
            </div>

            <div class="mb-3">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name_category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image">Gambar Baru (opsional)</label>
                <input type="file" name="image" class="form-control">
                @if($menu->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $menu->image) }}" width="120">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </section>
@endsection
