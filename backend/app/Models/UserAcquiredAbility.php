<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * A record to store the abilities acquired by a user.
 *
 * If there is a record with user Tom and ability "Dive in the sea",
 * that means that Tom has validated this ability this year.
 * @see Ability
 */
class UserAcquiredAbility extends Model
{
    Use HasUuids;
    protected $table = 'croc_users_acquired_abilities';

    protected $primaryKey = ['user_id', 'abil_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'abil_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function ability()
    {
        return $this->belongsTo(Ability::class, 'abil_id', 'abil_id');
    }
}