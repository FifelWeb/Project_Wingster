@extends('layouts.main')

@section('title', 'Add Category')

@section('content')
    <section class="content">
        {{-- Pesan notifikasi --}}
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session('pesan')[0] }}">
                {{ session('pesan')[1] }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 mt-3">
                <h1 class="h3 mb-3 text-gray-800">Form Tambah Kategori</h1>
            </div>

            <div class="col-lg-12 col-md-12 mt-3 pl-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{-- {{ route('category.store') }} --}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kategori</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                            <a href="{{ route('category.index') }}" class="btn btn-secondary mt-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
