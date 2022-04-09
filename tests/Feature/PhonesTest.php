<?php

namespace Tests\Feature;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhonesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_phones()
    {
        $customer = factory(Customer::class);
        dd($customer);
        $response = $this->get('/phones');

        $response->assertStatus(200);
    }
}
