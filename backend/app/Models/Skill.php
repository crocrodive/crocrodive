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
}
