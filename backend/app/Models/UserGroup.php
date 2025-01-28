<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserGroup extends Pivot
{
    use HasUuids;
    protected $table = 'croc_users_groups';
    protected $primaryKey = ['user_id', 'grou_id'];

    protected $fillable = [
        'user_id',
        'grou_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
