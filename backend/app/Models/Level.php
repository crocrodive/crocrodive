<?php

namespace App\Models;

/**
 * A level ("niveau" in french) here is a certification of a user's diving skills.
 *
 * It is used for both attendees and instructors.
 *
 * Levels serve two purposes :
 * - define the level of a course
 * - define the level of a diver
 *
 * A diver can only attend a course if he has the appropriate level.
 * (N3 cannot attend a N1 course).
 *
 * An instructor can only teach a course if he has the appropriate level.
 * - N1 can be teached with N2 onwards
 * - N2 and N3 require at least N4
 *
 * Course are provided only for N1, N2 and N3 levels.
 *
 * The beginner level ("Débutant") is a placeholder level,
 * it means the user has no certification.
 *
 * @property int $id Identifier for the level (incremental, ordered)
 * @property string $name Official (except "Débutant") name of the level
 * @property boolean $has_courses Whether courses for this level are provided or not
  */
class Level extends CustomPrefixedModel
{
    protected $table = 'croc_levels';
    protected string $prefix = 'leve_';
    protected $primaryKey = 'leve_id';

    public function instructorRequiredLevel()
    {
        return $this->belongsTo(Level::class, 'instructor_required_level_id', 'leve_id');
    }

    public static function getLevelsData()
    {
        return Level::where('leve_has_courses', "!=", "0")->get(['leve_id', 'leve_name', 'instructor_required_level_id']);
    }
}
