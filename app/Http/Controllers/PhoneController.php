<?php

namespace App\Http\Controllers;

use App\Filters\PhonesFilter;
use App\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function getPhones(PhonesFilter $filter){
        $customers=Customer::filter($filter)->paginate(5);
        return view('phones',['customers'=>CustomerResource::collection($customers)]);
    }
}
