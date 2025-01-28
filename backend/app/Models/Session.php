<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Session extends CustomPrefixedModel
{
    use HasUuids;

    protected $table = 'croc_sessions';
    protected string $prefix = 'sess_';
    protected $primaryKey = 'sess_id';

    protected $fillable = [
        'sess_date',
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'cour_id', 'cour_id');
    }
}
