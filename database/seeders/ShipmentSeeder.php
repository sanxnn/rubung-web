<?php
namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\Order;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::whereIn('status', ['shipped', 'delivered'])->get();
        $counter = 1;
        foreach ($orders as $o) {
            $isDelivered = $o->status === 'delivered';
            $ship = Shipment::create([
                'order_id' => $o->id,
                'courier' => 'JNE',
                'tracking_number' => 'JNE' . now()->format('Ymd') . str_pad((string) $counter, 4, '0', STR_PAD_LEFT),
                'scheduled_ship_date' => $o->agreed_delivery_date->copy()->subDay(),
                'shipped_at' => now()->subDay(),
                'delivered_at' => $isDelivered ? now() : null,
                'status' => $isDelivered ? 'delivered' : 'shipped',
            ]);

            $events = $isDelivered
                ? [['Picked Up', 'Barang diambil kurir', 'Solo'], ['In Transit', 'Dalam perjalanan', 'Jakarta'], ['Delivered', 'Diterima pembeli', $o->shipping_city]]
                : [['Picked Up', 'Barang diambil kurir', 'Solo'], ['In Transit', 'Dalam perjalanan', 'Jakarta']];
            $counter++;

            foreach ($events as $i => [$status, $desc, $loc]) {
                $ship->trackingHistories()->create([
                    'status' => $status,
                    'description' => $desc,
                    'location' => $loc,
                    'created_at' => now()->subDay()->addHours($i),
                ]);
            }
        }
    }
}