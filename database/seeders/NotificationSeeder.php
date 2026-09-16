<?php
namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $i => $u) {
            if ($i % 2 == 0) {
                Notification::create([
                    'user_id' => $u->id,
                    'title' => 'Selamat Datang',
                    'body' => 'Terima kasih telah bergabung.',
                    'is_read' => false,
                ]);
            }
        }
    }
}