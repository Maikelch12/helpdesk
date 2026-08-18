<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Hardware',
        ]);

        Category::create([
            'name' => 'Software',
        ]);

        Category::create([
            'name' => 'Redes',
        ]);

        Category::create([
            'name' => 'Accesos',
        ]);
    }
}
