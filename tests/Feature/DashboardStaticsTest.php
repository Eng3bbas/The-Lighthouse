<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthentication;

class DashboardStaticsTest extends TestCase
{
    use RefreshDatabase,WithFaker,WithAuthentication;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexPageCounts()
    {
        factory('App\Product',10)->create();
        factory('App\Order',10)->create();
        $this->setAuthentication(true);
        $response = $this->get(route('dashboard.index'));
        $response->assertSessionMissing('orders_empty');
    }
}
