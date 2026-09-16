<?php
namespace Database\Seeders;

use App\Models\CustomOrder;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomOrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        foreach ($users->take(5) as $u) {
            CustomOrder::create([
                'user_id' => $u->id,
                'customer_name' => $u->name,
                'customer_phone' => $u->phone,
                'description' => 'Custom batik untuk acara pernikahan.',
                'requested_price' => 2500000,
                'admin_price' => null,
                'status' => 'pending',
                'admin_note' => null,
            ]);
        }
    }
}