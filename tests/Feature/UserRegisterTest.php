<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that a user can register successfully.
     *
     * This test verifies that a user can register with valid credentials.
     * It checks that the response status is 201 Created and ensures that
     * the user record is present in the database with the provided email
     * and name.
     *
     * @return void
     */
    public function test_a_user_can_register(): void
    {
        $data = [
            'email' => 'johndoe@gmail.com',
            'password' => 'change_me',
            'name' => 'John',
            'last_name' => 'Doe',
        ];

        $response = $this->postJson("$this->apiBase/register", $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['email' => 'johndoe@gmail.com', 'name' => 'John', 'last_name' => 'Doe']);

        $response->assertJsonFragment([
            'message' => 'User registered successfully.',
            'status' => 201,
            'data' => [
                'user' => [
                    'email' => 'johndoe@gmail.com',
                    'name' => 'John',
                    'last_name' => 'Doe',
                    'id' => 1
                ]
            ]
        ]);
    }

    /**
     * Test that the email field is required for registration.
     *
     * This test verifies that attempting to register without providing an email
     * results in a 422 Unprocessable Entity response. It also checks that the
     * response contains the expected structure, including an 'errors' entry
     * with 'email' specified.
     *
     * @return void
     */
    public function test_email_must_be_required(): void
    {
        $data = [
            'email' => '',
            'password' => 'change_me',
            'name' => 'John',
            'last_name' => 'Doe',
        ];

        $response = $this->postJson("$this->apiBase/register", $data);

        $response->assertStatus(422);
        $response->assertJsonStructure(['data','message','status', 'errors' => ['email']]);
    }
}
