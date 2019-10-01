<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewSearhForm extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testViewSearch()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee("Trip Search");
    }
}
