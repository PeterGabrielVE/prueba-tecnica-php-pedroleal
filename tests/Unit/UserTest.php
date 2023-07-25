<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\UserController;
use App\Repositories\UserRepository;
use App\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\JsonResponse;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testIndex()
    {
        $userRepository = new UserRepository();
        $this->app->instance(UserRepository::class, $userRepository);

        $userFactory = new UserFactory();
        $this->app->instance(UserFactory::class, $userFactory);

        $controller = new UserController($userRepository,$userFactory);
        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertArrayHasKey('data', json_decode($response->getContent(), true));
    }

    public function test_create_user()
    {
        //$this->withoutExceptionHandling();
        Artisan::call('migrate');

        $data = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => '123456788',
        ];

        $this->json('POST', 'api/user/store',$data)
            ->assertStatus(200);
        
    }

    public function testUpdateUser()
    {
        /*$user = factory(User::class)->create();
        $newData = [
            'name' => 'New Name',
            'email' => 'newemail@example.com',
            // Include other fields to update
        ];

        $response = $this->json('PUT', "/users/{$user->id}", $newData, ['Accept' => 'application/json']);

        $response->assertStatus(200)
                ->assertJson([
                    'data' => true // Assuming the update method returns a boolean
                ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'newemail@example.com',
            // Include other fields to update
        ]);*/
    }
}
