<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Group of one instructor and a few attendees (usually two)
 * for a diving session.
 *
 * The course manager is responsible for creating them
 * for every session, that is assign attendees to instructors for
 * one session.
 *
 * @property string $id Identifier for the group (UUIDv4)
 * @property User $instructor Instructor of the diving group
 * @property \Illuminate\Database\Eloquent\Collection<string, User> $attendees
 * Attendees of the diving group
 * @property Session $session Session for which the group is formed.
 */
class DivingGroup extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_diving_groups';
    protected string $prefix = 'grou_';
    protected $primaryKey = 'grou_id';
    
    protected $fillable = [
        'instructor_user_id',
        'sess_id'
    ];
    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_user_id', 'user_id');
    }

    public function session() {
        return $this->belongsTo(Session::class, 'sess_id', 'sess_id');
    }

    public function attendees(): BelongsToMany {
        return $this->belongsToMany(User::class, 'croc_users_groups', 'grou_id', 'user_id');
    }
}
