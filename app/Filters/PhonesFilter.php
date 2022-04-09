<?php

namespace App\Filters;

use App\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PhonesFilter extends Filters
{


    protected $filters = ['country','state'];


    protected function country($country): Builder
    {
        return $this->builder->where('phone','like','('.config('countryCode.'.$country.'.countryCode').')%');
    }
    protected function state($state): Builder
    {
        if($state=='valid')
            return $this->builder->where('phone','REGEXP',"'". "(".implode(')|(',\Illuminate\Support\Arr::pluck(config('countryCode'),'regex')).")"."'");
        return $this->builder->where('phone','REGEXP',"'". "(^(?!".implode(')(?!',\Illuminate\Support\Arr::pluck(config('countryCode'),'regex')).")".")'");
    }



}
