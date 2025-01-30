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
        'skil_id',
    ];

    public function skill() {
        return $this->belongsTo(Skill::class, 'skil_id', 'skil_id');
    }
    public function getAbilitiesFromSkill($skillId) {
        return $this->where('skil_id', $skillId)->get();
    }
    public function createAbility($data) {
        return self::create($data);
    }
    public function getAbilitiesFromSkillLabel($skillId)
    {
        return $this->join('croc_skills', 'croc_abilities.skil_id', '=', 'croc_skills.skil_id')
                    ->where('croc_skills.skil_id', $skillId)
                    ->select('croc_abilities.abil_label', 'croc_abilities.abil_id')
                    ->get()
                    ->toArray();
    }
}