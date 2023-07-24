<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('migrate');

        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => '123456788',
        ];

        $response = $this->post(route('user/store'), $data);

        $response->assertStatus(302)->assertRedirect(route('allUsers'));

        $this->assertDatabaseHas('allUsers', $data);
    }
}
