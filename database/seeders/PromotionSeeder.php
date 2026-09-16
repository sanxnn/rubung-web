<?php
namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            ['name' => 'Diskon 30%', 'code' => 'WELCOME30', 'type' => 'percentage', 'value' => 30, 'min_purchase' => 500000, 'max_discount' => 200000, 'usage_limit' => 10],
            ['name' => 'Diskon Rp100rb', 'code' => 'BATIK100', 'type' => 'fixed', 'value' => 100000, 'min_purchase' => 800000, 'max_discount' => 100000, 'usage_limit' => 5],
            ['name' => 'Gratis Ongkir', 'code' => 'GRATIS15', 'type' => 'fixed', 'value' => 15000, 'min_purchase' => null, 'max_discount' => null, 'usage_limit' => null],
        ];
        foreach ($promos as $p) {
            Promotion::create(array_merge($p, [
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'is_active' => true,
            ]));
        }
    }
}