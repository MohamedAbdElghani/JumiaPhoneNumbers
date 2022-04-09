<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customer';

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
