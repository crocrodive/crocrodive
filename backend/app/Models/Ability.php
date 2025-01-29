<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * An ability ("aptitude" in french) is a part of a skill that must be validated by an attendee.
 *
 * To fully validate an ability, the attendee must have a good rating from an instructor for 3 consecutive sessions.
 *
 * @property string $id  Identifier for the ability (UUIDv4)
 * @property string $label Official text of the ability (from FFESSM)
 */
class Ability extends CustomPrefixedModel
{
    use HasUuids;

    protected $table = 'croc_abilities';
    protected string $prefix = 'abil_';
    protected $primaryKey = 'abil_id';

    protected $fillable = [
        'abil_label',
    ];

    public function skill() {
        return $this->belongsTo(Skill::class, 'skil_id', 'skil_id');
    }
}
