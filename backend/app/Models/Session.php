<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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

    public function getSessionDetails($userId)
    {
        return DB::table('croc_evaluations as ev')
            ->join('croc_abilities', 'ev.abil_id', '=', 'croc_abilities.abil_id')
            ->join('croc_ratings', 'ev.rati_id', '=', 'croc_ratings.rati_id')
            ->join('croc_sessions', 'ev.sess_id', '=', 'croc_sessions.sess_id')
            ->join('croc_diving_groups', 'ev.sess_id', '=', 'croc_diving_groups.sess_id')
            ->select('croc_abilities.abil_label', 'croc_ratings.rati_label', 'croc_sessions.sess_date', 'croc_sessions.instructor_user_id', 'croc_sessions.sess_id')
            ->where('croc_evaluations.user_id', $userId)
            ->get()
            ->groupBy('sess_id');
    }
}
