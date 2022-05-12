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

    /**
     * Test successful logout
     *
     * @return void
     */
    public function test_logout()
    {
        $user = User::create([
            'name' => 'sample',
            'email' => 'sample@test.com',
            'password' => bcrypt('sample123'),
            'role_id' => 1
        ]);

        $response = $this->json(
            'POST',
            '/oauth/token',
            [
                'client_id' => 2,
                'client_secret' => 'BkfldztBE3EiYq5oAX6hVln5DQTsw9B79T5LwDYD',
                'grant_type' => 'password',
                'username' => 'sample@test.com',
                'password' => 'sample123'
            ]
        );
        $response->assertStatus(200);
        $result = json_decode((string) $response->getContent());
        $accessToken = $result->access_token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])
        ->json('DELETE', 'api/logout');
        $response->assertStatus(200)
            ->assertJsonStructure(["status"]);
        $user->delete();
    }
}
