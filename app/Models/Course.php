<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
 protected $fillable = [
  'category_id',
  'title',
  'description',
  'is_premium',
  'rating',
  'students'
 ];

 public function students()
{
 return $this->belongsToMany(
  User::class,
  'enrollments'
 );
}

public function lessons()
{
 return $this->hasMany(Lesson::class);
}

public function certificates()
{
 return $this->hasMany(Certificate::class);
}
public function zoomMeetings()
{
    return $this->hasMany(ZoomMeeting::class);
}
public function orders()
{
    return $this->hasMany(Order::class);
}



}
