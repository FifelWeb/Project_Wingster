<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'code' => 'RPL/250428/001',
                'customer_name' => 'Budi',
                'date' => '2023-10-01',
                'subtotal' => 100000,
                'discount' => 0,
                'total' => 100000,
            ],
        ]);
    }
}
