<?php
namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $re = function (int $n): string {
            return 'RK-' . now()->format('Ymd') . '-' . strtoupper(substr(md5((string) $n), 0, 6));
        };

        $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'completed', 'cancelled'];
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($users->take(12) as $idx => $user) {
            $addr = $user->addresses()->first();
            if (!$addr) {
                continue;
            }
            $status = $statuses[array_rand($statuses)];
            $items = [];
            $subtotal = 0;
            for ($k = 0; $k < rand(1, 3); $k++) {
                $p = $products->random();
                $qty = rand(1, 3);
                $price = (float) $p->base_price;
                $subtotal += $price * $qty;
                $items[] = [$p, $qty, $price];
            }
            $discount = 0;
            $total = $subtotal - $discount;
            $paid = in_array($status, ['processing', 'shipped', 'delivered', 'completed']) ? $total : 0;

            $order = Order::create([
                'user_id' => $user->id,
                'custom_order_id' => null,
                'order_number' => $re($idx),
                'shipping_name' => $addr->recipient_name,
                'shipping_phone' => $addr->phone,
                'shipping_address' => $addr->address,
                'shipping_city' => $addr->city,
                'shipping_province' => $addr->province,
                'shipping_postal_code' => $addr->postal_code,
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'total' => $total,
                'dp_type' => null,
                'dp_value' => null,
                'dp_amount' => null,
                'paid_amount' => $paid,
                'remaining_amount' => $total - $paid,
                'payment_status' => $paid === $total ? 'paid' : ($paid > 0 ? 'partial' : 'pending'),
                'status' => $status,
                'agreed_delivery_date' => now()->addDays(rand(3, 14)),
                'snapshot_promo' => null,
                'snapshot_address' => [
                    'name' => $addr->recipient_name,
                    'phone' => $addr->phone,
                    'address' => $addr->address,
                    'city' => $addr->city,
                    'province' => $addr->province,
                    'postal_code' => $addr->postal_code,
                ],
            ]);

            foreach ($items as [$p, $qty, $price]) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $p->id,
                    'variant_id' => null,
                    'product_name' => $p->name,
                    'variant_name' => null,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $price * $qty,
                ]);
            }

            $order->payments()->create([
                'type' => 'full',
                'amount' => $total,
                'payment_method' => 'midtrans',
                'status' => $paid === $total ? 'paid' : 'failed',
                'paid_at' => $paid === $total ? now() : null,
            ]);
        }
    }
}