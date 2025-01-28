<?php

namespace App\Models;

class Level extends CustomPrefixedModel
{
    protected $table = 'croc_levels';
    protected string $prefix = 'leve_';
    protected $primaryKey = 'leve_id';
}
