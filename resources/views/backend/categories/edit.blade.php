@extends('layouts.main')
@section('content')

    <section class="content">
        <h1 class="h3 mb-2 text-gray-800">Form Ubah Kategory</h1>
        <form action="{{route('category.update')}}" method="post">
            @csrf
            <div class="col-lg-12 col-md-12 mt-3 pl-md-4">
                <div class="card">
                    <div class="card-body">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="name_category" class="form-control"  value="{{$categories->name_category}}">

                        <label for="status_category">Status</label>
                        <select name="status_category" class="form-control">
                            <option value="1" {{($categories->status_category == 1 )? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{($categories->status_category == 0 )? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                        <input type="hidden" name="id" value="{{$categories->id}}">
                        <button type="submit" class="mt-2 btn btn-primary">Edit</button>
                        <a href="{{ route('category.index') }}" class="mt-2 btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
