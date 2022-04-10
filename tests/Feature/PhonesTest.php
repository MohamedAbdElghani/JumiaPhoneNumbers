<?php

namespace Tests\Feature;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhonesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_view_phones()
    {
        factory(Customer::class,5)->create();
        $response = $this->get('/');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $response->assertStatus(200)->assertViewIs('countryPhones.phones');
        $this->assertCount(5,$data['data']['customers']);
    }

    public function test_pagination_limit()
    {
        factory(Customer::class,15)->create();
        $response = $this->get('/');
        $content = $response->getOriginalContent();

        $data = $content->getData();
        $this->assertCount(10,$data['data']['customers']);
    }

    public function test_state_filter(){
        $nonValidCustomerPhones=['(251) 9773199405','(251) 9773199405'];
        $validCustomerPhones=['(212) 698054317','(258) 847651504','(237) 695539786'];
        $fullArr=array_merge($nonValidCustomerPhones,$validCustomerPhones);
        foreach ($fullArr as $customerPhone){
            factory(Customer::class)->create([
                'phone'=>$customerPhone
            ]);
        }
        //test valid state
        $response = $this->get('/?state=valid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($validCustomerPhones),$data['data']['customers']);

        //test invalid state
        $response = $this->get('/?state=nonValid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($nonValidCustomerPhones),$data['data']['customers']);
    }



    public function test_country_filter(){
        $morocco=['(212) 6007989253','(212) 698054317'];
        $mozambique=['(258) 84330678235','(258) 847651504','(258) 7503O6263'];
        $fullArr=array_merge($morocco,$mozambique);
        foreach ($fullArr as $customerPhone){
            factory(Customer::class)->create([
                'phone'=>$customerPhone
            ]);
        }

        // test count of morocco phones
        $response = $this->get('/?country=Morocco');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($morocco),$data['data']['customers']);

        // test count of mozambique phones
        $response = $this->get('/?country=Mozambique');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($mozambique),$data['data']['customers']);

        //test country has no phones
        $response = $this->get('/?country=Cameroon');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(0,$data['data']['customers']);
    }



    public function test_country_and_state_filter(){
        $validMorocco=['(212) 698054317','(212) 633963130'];
        $invalidMorocco=['(212) 6007989253'];
        $validMozambique=['(258) 847651504','(258) 846565883','(258) 849181828'];
        $invalidMozambique=['(258) 84330678235','(258) 042423566'];
        $fullArr=array_merge($validMorocco,$invalidMorocco,$validMozambique,$invalidMozambique);
        foreach ($fullArr as $customerPhone){
            factory(Customer::class)->create([
                'phone'=>$customerPhone
            ]);
        }

        // test count of valid morocco phones
        $response = $this->get('/?country=Morocco&state=valid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($validMorocco),$data['data']['customers']);

        // test count of invalid morocco phones
        $response = $this->get('/?country=Morocco&state=nonValid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($invalidMorocco),$data['data']['customers']);

        // test count of valid mozambique phones
        $response = $this->get('/?country=Mozambique&state=valid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($validMozambique),$data['data']['customers']);

        // test count of invalid mozambique phones
        $response = $this->get('/?country=Mozambique&state=nonValid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(count($invalidMozambique),$data['data']['customers']);

        //test country has no phones
        $response = $this->get('/?country=Cameroon&state=nonValid');
        $content = $response->getOriginalContent();
        $data = $content->getData();
        $this->assertCount(0,$data['data']['customers']);
    }


}
