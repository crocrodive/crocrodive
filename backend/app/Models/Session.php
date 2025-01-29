<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

/**
 * A diving session ("séance" in french) of a course.
 *
 * Sessions last a few hours, they involve attendees and instructors.
 *
 * Sessions for a particular course always take place in the same location.
 * The diving location is defined in the course.
 *
 * @property string $id Identifier for the session (UUIDv4)
 * @property \DateTime $date Date and time of the session
 */
class Session extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_sessions';
    protected string $prefix = 'sess_';
    protected $primaryKey = 'sess_id';

    protected $fillable = [
        'sess_date',
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'cour_id', 'cour_id');
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class, 'sess_id', 'sess_id');
    }

    public function getUserSessionsDetails($userId)
    {
        return DB::table('croc_evaluations as ev')
            ->join('croc_abilities', 'ev.abil_id', '=', 'croc_abilities.abil_id')
            ->join('croc_ratings', 'ev.rati_id', '=', 'croc_ratings.rati_id')
            ->join('croc_sessions', 'ev.sess_id', '=', 'croc_sessions.sess_id')
            ->join('croc_diving_groups', 'ev.sess_id', '=', 'croc_diving_groups.sess_id')
            ->join('users', 'croc_diving_groups.instructor_user_id', '=', 'users.user_id')
            ->select('croc_abilities.abil_label', 'croc_ratings.rati_label', 'croc_sessions.sess_date', 'croc_diving_groups.instructor_user_id', 'croc_sessions.sess_id', 'users.user_firstname', 'users.user_lastname')
            ->where('ev.user_id',  $userId)
            ->get()
            ->toArray();}
}
