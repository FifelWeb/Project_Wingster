<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pesanan;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([UserSeeder::class]);
        $this->call ([
            ProductSeeder::class,
            TransactionSeeder::class,
            PesananSeeder::class,
            CategorySeeder::class,
            MenuSeeder::class,
            TableSeeder::class,
        ]);

    }
}
