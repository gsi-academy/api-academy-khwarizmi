<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'DISKON10',
            'type' => 'percentage',
            'value' => 10,
            'limit' => 100,
            'expires_at' => Carbon::now()->addMonth(),
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'HEMAT50K',
            'type' => 'fixed',
            'value' => 50000,
            'limit' => 50,
            'expires_at' => Carbon::now()->addWeeks(2),
            'is_active' => true,
        ]);
    }
}
