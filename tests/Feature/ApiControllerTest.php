<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Laravel\Passport\Passport;

class ApiControllerTest extends TestCase
{
    /**
     * Test login with correct credentials
     *
     * @return void
     */
    public function test_correct_credentials()
    {
        $user = User::create([
            'name' => 'sample',
            'email' => 'sample@test.com',
            'password' => bcrypt('sample123'),
            'role_id' => 1
        ]);

        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "success" => [
                    'roleId',
                    'token'
                ]
            ]);
            
        $this->assertAuthenticated();

        $user->delete();
    }

     /**
     * Test login with incorrect credentials
     *
     * @return void
     */
    public function test_incorrect_credentials()
    {
        $user = User::create([
            'name' => 'sample',
            'email' => 'sample@test.com',
            'password' => bcrypt('sample123'),
            'role_id' => 1
        ]);

        $loginData = ['email' => 'sample@test.com', 'password' => 'sample'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJsonStructure(["error"]);

        $user->delete();
    }
}
