<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'limit',
        'used',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    // 🔥 Check if coupon valid
    public function isValid()
    {
        if (!$this->is_active) return false;

        if ($this->expires_at && Carbon::today()->gt($this->expires_at)) {
            return false;
        }

        if ($this->used >= $this->limit) {
            return false;
        }

        return true;
    }

    // 🔥 Calculate discount
    public function calculateDiscount($amount)
    {
        if ($this->type === 'percentage') {
            return ($amount * $this->value) / 100;
        }

        return $this->value;
    }
}
