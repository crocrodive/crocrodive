<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * A French town defined by its INSEE code, postal code and name.
 * 
 * @property string $insee INSEE code of the town (primary key)
 * @property string $postal_code Postal code of the town
 * @property string $name Name of the town
 */
class Town extends CustomPrefixedModel {
    use HasFactory;
        protected $table = 'croc_towns';

        protected string $prefix = 'town_';

        protected $primaryKey = 'town_insee';
        public $incrementing = false;
        public $timestamps = false;

        protected $fillable = [
            'town_insee',
            'town_postal_code',
            'town_name',
        ];
}
