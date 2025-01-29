<?php

namespace App\Models;

/**
 * A rating ("notation" in french) is the actual value of an
 * evaluation given by an instructor.
 *
 * @property int $id Identifier for the rating (incremental, ordered)
 * @property string $label Text for the rating
 */
class Rating extends CustomPrefixedModel
{
    protected $table = 'croc_ratings';
    protected string $prefix = 'rati_';
    protected $primaryKey = 'rati_id';
}
