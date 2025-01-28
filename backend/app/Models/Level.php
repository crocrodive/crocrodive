<?php

namespace App\Models;

class Level extends CustomPrefixedModel
{
    protected $table = 'croc_levels';
    protected string $prefix = 'leve_';
    protected $primaryKey = 'leve_id';

    public function instructorRequiredLevel()
    {
        return $this->belongsTo(Level::class, 'instructor_required_level_id', 'leve_id');
    }
}
