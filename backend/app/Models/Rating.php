<?php

namespace App\Models;

class Rating extends CustomPrefixedModel
{
    protected $table = 'croc_ratings';
    protected string $prefix = 'rati_';
    protected $primaryKey = 'rati_id';
}
