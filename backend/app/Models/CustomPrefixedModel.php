<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class CustomPrefixedModel extends Model
{
    protected string $prefix = '';

    public function __get($key): mixed {
        return parent::__get($this->prefix . $key);
    }
}
