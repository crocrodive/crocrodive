<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * An evaluation is given to an attendee during a diving session for
 * a specific ability.
 *
 * It's an assocation table between :
 * - users
 * - abilities
 * - sessions
 * - ratings (the actual evaluation given by the instructor)
 *
 * This table serves two purposes :
 * - to store which abilities an attendee has to work on during a session
 * - to store the evaluation given by the instructor for each ability during a session
 *
 * @property string $id Identifier for the evaluation (UUIDv4)
 * @property string $comment Comment given by the instructor alongside his rating
 */
class Evaluation extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_evaluations';
    protected string $prefix = 'eval_';
    protected $primaryKey = 'eval_id';

    protected $fillable = [
        'user_id',
        'abil_id',
        'sess_id',
        'rati_id',
        'eval_comment',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function ability() {
        return $this->belongsTo(Ability::class, 'abil_id', 'abil_id');
    }

    public function session() {
        return $this->belongsTo(Session::class, 'sess_id', 'sess_id');
    }

    public function rating() {
        return $this->belongsTo(Rating::class, 'rati_id', 'rati_id');
    }
}
