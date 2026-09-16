<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin Batik',
            'email' => 'admin@rubung.id',
            'phone' => '081234567890',
        ]);
        User::factory(15)->create();
    }
}
