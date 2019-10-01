<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTripDetails extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testViewTripDetails()
    {

        $response = $this->get('trip_details/{608}');
        $response->assertStatus(200);
    }
}
