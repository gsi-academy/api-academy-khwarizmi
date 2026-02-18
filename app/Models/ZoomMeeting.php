<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'mentor_name',
        'scheduled_at',
        'zoom_link',
        'meeting_id',
        'passcode',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // Relation
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
