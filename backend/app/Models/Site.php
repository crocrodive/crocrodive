<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Site extends CustomPrefixedModel
{
    use HasUuids;
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