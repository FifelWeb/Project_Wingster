<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name_category' =>'Makanan',
            'status_category'=>1
        ]);
        Category::create([
            'name_category' =>'Minuman',
            'status_category'=>1
        ]);
        Category::create([
            'name_category' =>'Snack',
            'status_category'=>1
        ]);
    }
}
