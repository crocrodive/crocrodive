<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Record to store participation of users to courses.
 *
 * This is for attendees and instructors, but the manager is handled 
 * with a foreign key in the course table.
 */
class UserCourse extends Model
{
    use HasUuids;
    protected $table = 'croc_users_courses';

    protected $primaryKey = ['user_id', 'cour_id'];
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'cour_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'cour_id', 'cour_id');
    }
}
