<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class CustomPrefixedModel extends Model
{
    protected string $prefix = '';

    public function __get($key): mixed {
        if(! $this->isRelation($key) && ! $this->hasAttribute($key)) {
            $key = $this->prefix . $key;
        }

        return parent::__get($key);
    }
}
