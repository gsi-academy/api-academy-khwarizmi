<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
 protected $fillable = [
  'course_id',
  'mentor_id',
  'title',
  'description',
  'order',
  'whatsapp_link'
 ];

 public function course()
 {
  return $this->belongsTo(Course::class);
 }

 public function videos()
{
 return $this->hasMany(LessonVideo::class);
}

public function resources()
{
 return $this->hasMany(LessonResource::class);
}

public function progress()
{
 return $this->hasMany(LessonProgress::class);
}

public function assignments()
{
 return $this->hasMany(Assignment::class);
}
public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }


}
