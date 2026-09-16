<?php
namespace Database\Seeders;

use App\Models\PackageItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PackageItemSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::inRandomOrder()->take(3)->get();
        foreach ($products as $p) {
            PackageItem::create([
                'product_id' => $p->id,
                'variant_id' => null,
                'quantity' => 1,
                'sort_order' => 1,
            ]);
        }
    }
}
