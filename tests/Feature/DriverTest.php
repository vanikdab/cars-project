<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //Todo not finished (...
    public function testRoutes()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@admin.ru',
            'password' => '11111111']
        );

        $response->assertStatus(200);
    }
}
