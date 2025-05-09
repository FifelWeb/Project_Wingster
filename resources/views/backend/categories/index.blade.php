@extends('layouts.main')
@section('title','Category')
@section('content')

    <section class="content">
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session('pesan')[0] }}">
                {{ session('pesan')[1] }}
            </div>
        @endif

        <div class="row mt-3 mb-2">
            <div class="col d-flex justify-content-between align-items-center">
                <h1 class="h3 text-gray-800 mb-0">List Kategori</h1>
                <a href="{{route('categories.add')}}" class="btn btn-sm btn-primary">Tambah Kategori</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mt-3 pl-md-4">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name_category }}</td>
                                    <td>{{ $category->description_category }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                                        <form id="#" action="#" method="post" style="display:none;">
                                            @csrf
                                        </form>

                                        <a onclick="/*confirmDelete*/" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
