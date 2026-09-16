<?php
namespace Database\Seeders;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $p) {
            for ($i = 1; $i <= 2; $i++) {
                ProductImage::create([
                    'product_id' => $p->id,
                    'image_url' => '/images/batik-' . $p->id . '-' . $i . '.jpg',
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
