<?php
namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::where('role', 'user')->get() as $u) {
            Cart::create(['user_id' => $u->id]);
        }
    }
}