<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

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
