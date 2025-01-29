<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A diving course for the current year ("formation" in french).
 *
 * A diving course has a manager, and a team of instructors.
 *
 * Each course focus on a specific level of certification.
 *
 * Each year, the technical director of the club defines the courses
 * that will be organized.
 *
 * @property string $id Identifier for the course (UUIDv4)
 * @property \Date $start_date Date of the beginning of the course
 */
class Course extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_courses';
    protected string $prefix = 'cour_';
    protected $primaryKey = 'cour_id';

    protected $fillable = [
        'cour_start_date',
    ];

    public function manager() {
        return $this->belongsTo(User::class, 'manager_user_id', 'user_id');
    }

    public function level() {
        return $this->belongsTo(Level::class, 'leve_id', 'leve_id');
    }

    public function site() {
        return $this->belongsTo(Site::class, 'site_id', 'site_id');
    }

    public function sessions() {
        return $this->hasMany(Session::class, 'cour_id', 'cour_id');
    }
}
