<?php

namespace Modules\Accounts\tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Try register with invalid credentials
     *
     * @return void
     * @test
     */
    public function test_validation_rules()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'invalid_email',
            'phone' => '',
            'password' => '123',
            'password_confirmation' => '321',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password', 'phone']);
    }


    /**
     * Try register with valid credentials
     *
     * @return void
     * @test
     */
    public function test_successful_registration()
    {
        $response = $this->postJson(route('account.register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '01023331690',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'success',
                'data',
                'message'
            ]);

        $this->assertDatabaseHas('accounts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }
}
