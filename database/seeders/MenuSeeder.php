<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah ada minimal 1 kategori
        if (Category::count() === 0) {
            $this->command->warn('Belum ada kategori. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        $kategori = Category::inRandomOrder()->first(); // ambil satu kategori acak

        Menu::create([
            'name_menu' => 'Ayam Geprek',
            'description' => 'Ayam goreng krispi dengan sambal pedas.',
            'price' => 18000,
            'category_id' => $kategori->id,
            'image' => "Fifel.png,",
            'is_available' => true,
        ]);

        Menu::create([
            'name_menu' => 'Es Teh Manis',
            'description' => 'Minuman segar dengan gula cair.',
            'price' => 5000,
            'category_id' => $kategori->id,
            'image' => null,
            'is_available' => true,
        ]);

        /*Menu::factory()->count(3)->create(); // jika Anda punya factory*/
    }
}
