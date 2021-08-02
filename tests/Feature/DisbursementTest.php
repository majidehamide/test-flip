<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DisbursementTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_not_exist_route()
    {
        $response = $this->get('/not_exist_route_in_my_application');

        $response->assertStatus(404);
    }
    public function test_not_exist_method()
    {
        $response = $this->delete('/');

        $response->assertStatus(405);
    }

    public function test_root()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_disbursement()
    {
        $response = $this->get('/disbursement');

        $response->assertStatus(200);
    }

    public function test_post_disbursement()
    {

        $response = $this->json('post', '/disbursement', ['_token' => csrf_token(), 'bank_code' => 'bni', 'bank_code' => 'bni', 'account_number' => '31312321321321', 'amount' => 10000]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }



    public function test_get_disbursement_by_id()
    {
        $response = $this->get('/disbursement/check/' . 100);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
