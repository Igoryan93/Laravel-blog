<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */

    public function basicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

    }


}
