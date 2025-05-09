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
            'description_category'=>'Makanan'
        ]);
        Category::create([
            'name_category' =>'Minuman',
            'description_category'=>'Minuman'
        ]);
        Category::create([
            'name_category' =>'Snack',
            'description_category'=>'Snack'
        ]);
    }
}
