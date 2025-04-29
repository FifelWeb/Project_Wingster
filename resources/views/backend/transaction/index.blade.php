@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col-lg-12 px-md-4">
            <h1 class="h3 mb-2 text-gray-800">App Transaction</h1>
        </div>
        <div class="col-lg-12 px-md-4">
            <input type="text" id="input-barcode" name="barcode" class="form-control" placeholder="Scan Barcode"/>
        </div>
    </div>
    <form method="post" action="{{route('transaction.insert')}}">
        @csrf
        <div class="row">
            <div class="col-lg-8 col-md-12 mt-3 pl-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customer-name">Nama Pelanggan</label>
                            <input type="text" id="customer-name" name="customer_name" class="form-control" placeholder="Nama Pelanggan" required>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="table-cart">
                                <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-3 pr-md-4">
                <div class="card">
                    <div class="card-body overflow-auto">
                        <table width="100%" id="total-section">
                            <tr>
                                <td class="h3 text-center">Total Belanja</td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="subtotal">Subtotal</label>
                                    <input type="text" readonly name="subtotal" id="subtotal" class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="discount">Discount (%)</label>
                                    <input type="number" min="0" max="100" name="discount" id="discount" value="0" class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="total">Total</label>
                                    <input type="text" readonly name="total" id="total" class="form-control text-right">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12 px-md-4">
            <h1 class="h3 mb-2 text-gray-800">List Transaction</h1>
        </div>
        <div class="col-lg-12 px-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->customer_name}}</td>
                                    <td>{{$transaction->code}}</td>
                                    <td>{{$transaction->date}}</td>
                                    <td>{{$transaction->subtotal}}</td>
                                    <td>{{$transaction->discount . "%"}}</td>
                                    <td>{{$transaction->total}}</td>
                                <tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            // Event untuk input barcode
            $('#input-barcode').on('keypress', function (e) {
                if (e.which === 13) {
                    console.log('Enter di klik');
                    //pencarian data via ajax
                    $.ajax({
                        url: '{{url('/transaction/search-barcode')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            barcode: $(this).val()
                        },
                        success: function (data) {
                            addProductToTable(data);
                            toastr.success('Barang Berhasil masuk ke keranjang belanja', 'Berhasil');
                            $('#input-barcode').val('');
                        },
                        error: function () {
                            toastr.error('Barang yang dicari tidak ditemukan', 'Error');
                            $('#input-barcode').val('');
                        }
                    })
                }
            });

            // Fungsi untuk menambahkan produk ke tabel
            function addProductToTable(product) {
                let rowExist = $('#table-cart tbody').find('#p-' + product.barcode);
                if (rowExist.length > 0) {
                    //barcode sudah ada
                    let qty = parseInt(rowExist.find('.qty').eq(0).val());
                    qty += 1;
                    rowExist.find('.qty').eq(0).val(qty);
                    rowExist.find('td').eq(3).text(qty);
                    rowExist.find('td').eq(4).text((qty * product.price));
                } else {
                    let row = '';
                    row += `<tr id='p-${product.barcode}'>`;
                    row += `<td>${product.barcode}</td>`;
                    row += `<td>${product.name}</td>`;
                    row += `<td>${product.price}</td>`;
                    row += `<input type='hidden' name='price[]' class='price' value="${product.price}" />`;
                    row += `<input type='hidden' name='qty[]' class='qty' value="1" />`;
                    row += `<input type='hidden' name='id[]' value="${product.id}" />`;
                    row += `<td>1</td>`;
                    row += `<td>${product.price}</td>`;
                    row += `</tr>`;
                    $('#table-cart tbody').append(row);
                }
                hitungTotalBelanja();
            }

            // Fungsi untuk menghitung total belanja
            function hitungTotalBelanja() {
                let subtotal = 0;
                $('#table-cart tbody tr').each(function() {
                    let price = parseFloat($(this).find('.price').val());
                    let qty = parseInt($(this).find('.qty').val());
                    subtotal += price * qty;
                });
                let discount = parseInt($('#discount').val());
                let total = subtotal - (subtotal * discount / 100);
                $('#subtotal').val(subtotal);
                $('#total').val(total);
            }


            // Event untuk menghitung ulang total belanja ketika diskon diubah
            $('#discount').on('change', function () {
                hitungTotalBelanja();
            });

            // Event untuk submit form
            $('form').on('submit', function (e) {
                if ($('#table-cart tbody tr').length === 0) {
                    e.preventDefault();
                    toastr.error('Keranjang belanja kosong. Silakan tambahkan produk terlebih dahulu.', 'Error');
                }
            });
        });

    </script>
@endpush
