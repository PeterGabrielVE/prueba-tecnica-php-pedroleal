<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_create_user()
    {
        //$this->withoutExceptionHandling();

        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => '123456788',
        ];

        $response = $this->post('/users', $data);

        $response->assertRedirect('/users');

        $this->assertDatabaseHas('users', $data);
    }
}
