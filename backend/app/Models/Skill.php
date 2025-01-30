<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * The FFESSM define skills ("compétences" in french) that must be acquired for each level.
 *
 * Skills are themselves divided into abilities ("aptitudes" in french).
 *
 * An attendee validates a skill by validating each of its abilities.
 *
 * @property string $id Identifier for the skill (UUIDv4)
 * @property string $label Official text for the skill
 */
class Skill extends CustomPrefixedModel
{
    use HasUuids;
    protected $table = "croc_skills";
    protected string $prefix = "skil_";

    protected $primaryKey = 'skil_id';

    protected $fillable = [
        "skil_id",
        "leve_id",
        "skil_label",
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, "leve_id", "leve_id");
    }

    public function getSkillsFromLevelLabel($leve_label)
    {
        return $this->join('croc_levels', 'croc_skills.leve_id', '=', 'croc_levels.leve_id')
                    ->where('croc_levels.leve_name', $leve_label)
                    ->select('croc_skills.skil_label','croc_skills.skil_id')
                    ->orderBy('croc_skills.skil_label','asc')
                    ->get()
                    ->toArray();
    }

    public function createSkill($data)
    {
        return self::create($data);
    }

    public function createSkillAtLevelName($data, $leve_name)
    {
        $level = Level::where('leve_name', $leve_name)->first();
        if ($level) {
            $data['leve_id'] = $level["leve_id"];
            return self::create($data);
        }
        return null;
    }
    public function deleteSkill($skil_id)
    {
        Ability::where('skil_id', $skil_id)->delete();
        return self::where('skil_id', operator: $skil_id)->delete();
    }

    public function updateLabel($skil_id, $skil_label){
    return self::where('skil_id', $skil_id)
            ->update(['skil_label' => $skil_label]);
    }
}