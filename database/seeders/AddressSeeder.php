<?php
namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::where('role', 'user')->get() as $u) {
            Address::create([
                'user_id' => $u->id,
                'label' => 'Rumah',
                'recipient_name' => $u->name,
                'phone' => $u->phone,
                'address' => 'Jl. Merdeka No. 1',
                'city' => 'Solo',
                'province' => 'Jawa Tengah',
                'postal_code' => '57100',
                'is_default' => true,
            ]);
        }
    }
}