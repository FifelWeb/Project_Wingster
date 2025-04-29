<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'barcode' => '001',
                'name' => 'Product 1',
                'price' => 10000,
                'gambar_product' => 'product1.jpg',
                'isi_product' => 'Description of Product 1',
            ],
            [
                'barcode' => '002',
                'name' => 'Product 2',
                'price' => 20000,
                'gambar_product' => 'product2.jpg',
                'isi_product' => 'Description of Product 2',
            ],
        ]);
    }
}
