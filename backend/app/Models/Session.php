<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_sessions';
    protected string $prefix = 'sess_';
    protected $primaryKey = 'sess_id';

    protected $fillable = [
        'sess_date',
    ];

    public function course() {
        return $this->belongsTo(Course::class, 'cour_id', 'cour_id');
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class, 'sess_id', 'sess_id');
    }
}
