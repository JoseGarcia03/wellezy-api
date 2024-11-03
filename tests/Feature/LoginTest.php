<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
     * Test that an existing user can login successfully.
     *
     * This test verifies that an existing user can login with valid credentials
     * and that the response status is 200 OK. It also checks that the response
     * contains a 'token' within the 'data' structure.
     *
     * @return void
     */
    public function test_an_existing_user_can_login(): void
    {
        $this->withoutExceptionHandling();

        $credentials = ['email' => 'admin@wellezy.com', 'password' => 'change_me'];

        $response = $this->postJson("{$this->apiBase}/login", $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }

    /**
     * Test that a non-existing user cannot login.
     *
     * This test verifies that attempting to login with credentials
     * for a user that does not exist results in a 401 Unauthorized response.
     * It also checks that the error message returned is 'Password or email incorrect'.
     *
     * @return void
     */
    public function test_a_non_existing_user_cannot_login(): void
    {
        $credentials = ['email' => 'example@example.com', 'password' => 'change_me'];

        $response = $this->postJson("{$this->apiBase}/login", $credentials);

        $response->assertStatus(401);
        $response->assertJsonFragment(['message' => 'Password or email incorrect']);
    }

    /**
     * Test that the email field is required for login.
     *
     * This test verifies that attempting to login without providing an email
     * results in a 422 Unprocessable Entity response. It also checks that the
     * response contains the expected structure, including an 'errors' entry
     * with 'email' specified.
     *
     * @return void
     */
    public function test_email_must_be_required(): void
    {
        $credentials = ['password' => 'change_me'];

        $response = $this->postJson("{$this->apiBase}/login", $credentials);

        $response->assertStatus(422);
        $response->assertJsonStructure(['data','message','status', 'errors' => ['email']]);
    }
}
