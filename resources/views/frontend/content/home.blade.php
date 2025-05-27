@extends('frontend.layout.main')
@section('content')
    <!-- Section -->
    <section class="py-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center">
                    <h2 class="fw-bolder">Menu Kami</h2>
                    <p class="lead fw-normal text-muted mb-5">Nikmati beragam menu terbaik dari kami, tersedia untuk Anda setiap hari!</p>
                </div>
            </div>
        </div>

        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($menus as $menu)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Gambar Menu -->
                            <img class="card-img-top" src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name_menu }}" />

                            <!-- Detail Menu -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $menu->name_menu }}</h5>
                                    <p class="text-muted small">{{ $menu->description }}</p>
                                    <p class="text-dark fw-bold">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="#">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


