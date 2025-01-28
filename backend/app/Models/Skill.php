<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

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
