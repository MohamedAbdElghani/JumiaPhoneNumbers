<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Customer extends Model
{
    protected $table='customer';
    public $timestamps = false;

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getStateAttribute(){
        return preg_match("'". "(".implode(')|(',\Illuminate\Support\Arr::pluck(config('countryCode'),'regex')).")"."'",$this->phone);
    }

    public function getCountryAttribute(){
        return array_keys(Arr::where(config('countryCode'), function ($value, $key) {
            return str_contains($this->phone,'('.$value['countryCode'].')');
        }))[0]??null;
    }

    public function getCountryCodeAttribute(){
        return config('countryCode.'.$this->country.'.countryCode');
    }

    public function getPhoneWithoutCodeAttribute(){
        $phoneSlices=explode(' ', $this->phone)[1];
        return $phoneSlices;
    }
}
