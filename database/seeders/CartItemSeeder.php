<?php
namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        $carts = Cart::all();
        $products = Product::all();
        foreach ($carts as $cart) {
            $p = $products->random();
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $p->id,
                'variant_id' => null,
                'quantity' => rand(1, 3),
            ]);
        }
    }
}