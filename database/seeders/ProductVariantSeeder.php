<?php
namespace Database\Seeders;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $p) {
            ProductVariant::create([
                'product_id' => $p->id,
                'name' => 'Varian Utama',
                'sku' => 'SKU-' . $p->id,
                'price' => $p->base_price,
                'stock' => rand(5, 30),
                'is_active' => true,
            ]);
        }
    }
}
