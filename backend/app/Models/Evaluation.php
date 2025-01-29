<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_evaluations';
    protected string $prefix = 'eval_';
    protected $primaryKey = 'eval_id';

    protected $fillable = [
        'eval_comment',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function ability() {
        return $this->belongsTo(Ability::class, 'abil_id', 'abil_id');
    }

    public function session() {
        return $this->belongsTo(Session::class, 'sess_id', 'sess_id');
    }

    public function rating() {
        return $this->belongsTo(Rating::class, 'rati_id', 'rati_id');
    }
}
