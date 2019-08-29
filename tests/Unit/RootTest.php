<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RootTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRootView()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
