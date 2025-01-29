<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A site is a location for doing diving sessions.
 *
 * It can either be a swimming pool or somewhere in the sea.
 *
 * Either way, we store a meaningful name for the technical director 
 * and course managers, as well as an address for the attendees
 * so they know where to go.
 *
 * @property string $id Identifier for the site (UUIDv4)
 * @property string $name Name of the site for managers
 * @property string $address Address of the site for attendees
 * (example : "2 rue Robert Taron")
 */
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