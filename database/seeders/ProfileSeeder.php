<?php

namespace Database\Seeders;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Profile::create([
                'user_id' => $user->id,
                'phone' => '08' . rand(1111111111, 9999999999),
                'bio' => "Bio {$user->name}",
                'avatar' => null,
            ]);
        });
    }
}
