<?php

namespace Database\Seeders;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::role('student')->first();

        Subscription::create([
            'user_id' => $student->id,
            'type' => 'PRO',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
        ]);
    }
}
