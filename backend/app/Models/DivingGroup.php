<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DivingGroup extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_diving_groups';
    protected string $prefix = 'grou_';
    protected $primaryKey = 'grou_id';

    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_user_id', 'user_id');
    }

    public function session() {
        return $this->belongsTo(Session::class, 'sess_id', 'sess_id');
    }
}
