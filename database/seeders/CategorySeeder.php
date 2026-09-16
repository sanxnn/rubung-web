<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Batik Tulis', 'Batik Cap', 'Batik Printing',
            'Sarimbit', 'Kain Panjang', 'Mukena', 'Batik Modern',
        ];
        foreach ($names as $i => $name) {
            Category::create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
                'description' => 'Kategori ' . $name,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
