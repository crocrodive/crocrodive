<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends CustomPrefixedModel
{
    use HasUuids, HasFactory;
    protected $table = 'croc_sites';
    protected string $prefix = 'site_';

    protected $primaryKey = "site_id";

    protected $fillable = [
        'site_id',
        'town_insee',
        'site_name',
        'site_address'
    ];

    public function town() {
        return $this->belongsTo(Town::class, 'town_insee', 'town_insee');
    }
}