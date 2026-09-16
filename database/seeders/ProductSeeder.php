<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        foreach ($categories as $cat) {
            for ($i = 1; $i <= 4; $i++) {
                Product::create([
                    'category_id' => $cat->id,
                    'name' => 'Batik ' . $cat->name . ' ' . $i,
                    'slug' => \Illuminate\Support\Str::slug('Batik ' . $cat->name . ' ' . $i),
                    'description' => 'Produk batik kualitas premium.',
                    'base_price' => rand(200000, 1200000),
                    'stock' => rand(10, 100),
                    'is_active' => true,
                ]);
            }
        }
    }
}
