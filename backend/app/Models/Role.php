<?php

namespace App\Models;

/**
 * Define the role of a user for permissions management.
 *
 * @property string $id Identifier for the role.
 *
 * We designed the id as a key because we didn't want it to change,
 * unless changing the business logic.
 *
 * But due to needing a text to display, and not having translation set up,
 * it is currently used as a display name.
 *
 * @see \App\Enum\Roles for the actual roles that exist
 */
class Role extends CustomPrefixedModel
{
    protected $table = 'croc_roles';
    protected string $prefix = 'role_';
    protected $primaryKey = 'role_id';
    public $incrementing = false;
}
