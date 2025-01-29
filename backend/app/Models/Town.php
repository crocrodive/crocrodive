<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


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
