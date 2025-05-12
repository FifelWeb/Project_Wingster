@extends('layouts.main')
@section('title','Dashboard')
@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ daily sales section ] start -->
        <div class="row">
            <!-- Card Menu -->
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body position-relative">
                        <h6 class="mb-2">Menu</h6>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="h4 font-weight-bold text-primary">{{ $totalMenu }}</div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="bg-primary text-white rounded-circle p-3">
                                    <i class="fas fa-utensils fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('menu.index') }}" class="small d-block mt-3 text-primary">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Transaction -->
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body position-relative">
                        <h6 class="mb-2">Transaction</h6>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="h4 font-weight-bold text-success">{{ $totalTransaction }}</div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="bg-success text-white rounded-circle p-3">
                                    <i class="fas fa-receipt fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('transaction.index') }}" class="small d-block mt-3 text-success">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Category Menu -->
            <div class="col-md-12 col-xl-4 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body position-relative">
                        <h6 class="mb-2">Category Menu</h6>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="h4 font-weight-bold text-warning">{{ $totalCategory }}</div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="bg-warning text-white rounded-circle p-3">
                                    <i class="fas fa-layer-group fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('category.index') }}" class="small d-block mt-3 text-warning">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Menu</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                </tr>
                                </thead>
                                @foreach($latestWingster as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name_menu}}</td>
                                        <td>{{$row->categories->name_category}}</td>
                                        <td>{{$row->price}}</td>
                                        <td><img src="{{ asset('storage/' . $row->image)}}" alt="Post Image" style="width: 50px; height: 50px"></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
