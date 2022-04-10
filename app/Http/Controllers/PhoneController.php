<?php

namespace App\Http\Controllers;

use App\Filters\PhonesFilter;
use App\Customer;
use App\Http\Resources\CustomerResource;

class PhoneController extends Controller
{
    public function getPhones(PhonesFilter $filter){
        $customers=Customer::filter($filter)->paginate(5);
        return view('countryPhones.phones',[
            'customers'=>CustomerResource::collection($customers),
            'countries' => array_keys(config('countryCode'))
        ]);
    }
}
