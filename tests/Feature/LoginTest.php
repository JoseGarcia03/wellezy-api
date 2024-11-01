<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }
    /**
     * @test
     * A basic feature test example.
     */
    public function an_existing_user_can_login(): void
    {
        $credentials = ['email' => 'admin@travel.com', 'password' => 'change_me'];

        $response = $this->post("{$this->apiBase}/login", $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    /**
     * @test
     * A basic feature test example.
     */
    public function a_non_existing_user_cannot_login(): void
    {
        $credentials = ['email' => 'example@example.com', 'password' => 'hello'];

        $response = $this->post('api/v1/login', $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    /**
     * @test
     * A basic feature test example.
     */
    public function mail_must_be_required(): void
    {
        $credentials = ['password' => 'hello'];

        $response = $this->post('api/v1/login', $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    /**
     * @test
     * A basic feature test example.
     */
    public function password_must_be_required(): void
    {
        $credentials = ['email' => 'example@example.com'];

        $response = $this->post('api/v1/login', $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }
}
