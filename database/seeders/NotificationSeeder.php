<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Notification::create([
            'user_id' => $user->id,
            'title' => 'Welcome 🎉',
            'message' => 'Welcome to the LMS platform!',
            'is_read' => false,
        ]);
    }
}
