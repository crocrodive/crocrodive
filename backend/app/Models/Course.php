<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends CustomPrefixedModel
{
    use HasUuids, HasFactory;

    protected $table = 'croc_courses';
    protected string $prefix = 'cour_';
    protected $primaryKey = 'cour_id';

    protected $fillable = [
        'cour_start_date',
    ];

    public function manager() {
        return $this->belongsTo(User::class, 'manager_user_id', 'user_id');
    }

    public function level() {
        return $this->belongsTo(Level::class, 'leve_id', 'leve_id');
    }

    public function site() {
        return $this->belongsTo(Site::class, 'site_id', 'site_id');
    }
}
