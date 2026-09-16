<?php
namespace Database\Seeders;

use App\Models\DeliveryReschedule;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DeliveryRescheduleSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::inRandomOrder()->take(5)->get();
        $counter = 1;
        foreach ($orders as $o) {
            DeliveryReschedule::create([
                'order_id' => $o->id,
                'original_date' => $o->agreed_delivery_date,
                'requested_date' => $o->agreed_delivery_date->copy()->subDay(),
                'reason' => 'Perlu produk lebih cepat.',
                'status' => $counter % 2 === 0 ? 'approved' : 'rejected',
                'admin_note' => $counter % 2 === 0 ? 'Disetujui.' : 'Ditolak.',
            ]);
            $counter++;
        }
    }
}