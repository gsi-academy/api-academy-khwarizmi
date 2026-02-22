<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Pastikan relasi ini ada agar whereHas('courses') bisa jalan
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}