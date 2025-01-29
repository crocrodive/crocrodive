<?php

namespace App\Models;

class Role extends CustomPrefixedModel
{
    protected $table = 'croc_roles';
    protected string $prefix = 'role_';
    protected $primaryKey = 'role_id';
    public $incrementing = false;
}
