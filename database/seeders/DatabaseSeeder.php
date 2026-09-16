<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            ProductImageSeeder::class,
            PackageItemSeeder::class,
            AddressSeeder::class,
            NotificationSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            PromotionSeeder::class,
            CustomOrderSeeder::class,
            OrderSeeder::class,
            DeliveryRescheduleSeeder::class,
            ShipmentSeeder::class,
        ]);
    }
}