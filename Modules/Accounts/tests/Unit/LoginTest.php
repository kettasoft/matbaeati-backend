<?php

namespace Modules\Accounts\tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Accounts\Entities\Account;
use Modules\Accounts\Entities\Office;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // set your headers here
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    /**
     * Try login with invalid credentials
     *
     * @return void
     * @test
     */
    public function login_validation()
    {
        $this->postJson(route('account.login'), [])
            ->assertSee('errors')
            ->assertJsonStructure([
                'errors',
                'message'
            ]);
    }

    /**
     * Try login with valid credentials
     *
     * @return void
     * @test
     */
    public function login_success()
    {
        $account = Office::factory()->create();

        $response = $this->postJson(route('account.login'), [
            'username' => $account->email,
            'password' => 'password',
            'device_name' => 'testing',
        ]);

        $response->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data',
                'message',
                'success'
            ]);
    }
}
