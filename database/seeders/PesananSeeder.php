<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    $products = Product::all();
        if ($products->count() > 0){
            $pesananData = [
            [
                'nama_pelanggan' => 'Jhon',
                'product_id' => $products[0]->id,
                'jumlah' => 2,
                'total_harga' => $products[0]->price * 2,
                'status' => 'pending',
            ],
                [
                    'nama_pelanggan' => 'Jhon',
                    'product_id' => $products[0]->id,
                    'jumlah' => 2,
                    'total_harga' => $products[0]->price * 2,
                    'status' => 'pending',
                ],
        ];
            DB::table('pesanans')->insert($pesananData);    }
    }
}
