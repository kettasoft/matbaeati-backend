<?php

namespace Modules\Accounts\tests\Unit;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Accounts\Entities\Office;

class ProfileTest extends TestCase
{
    /** @test */
    public function only_to_authenticated_user_can_display_his_profile()
    {
        $account = Office::factory()->create();

        $this->getJson(route('account.profile.show'))
            ->assertStatus(401);

        Sanctum::actingAs($account, ['*']);

        $this->getJson(route('account.profile.show'))
            ->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);
    }

    /** @test */
    public function only_to_authenticated_account_can_update_his_profile()
    {
        $account = Office::factory()->create([
            'name' => 'Ahmed',
            'email' => 'ahmed@demo.com',
            'phone' => '123456789',
        ]);

        $this->postJson(route('account.profile.update'))
            ->assertStatus(401);

        Sanctum::actingAs($account, ['*']);

        // test validation

        $this->postJson(route('account.profile.update'), [
            'name' => 'Ahmed',
            'email' => 'ahmed@demo.com',
            'phone' => '123456789',
        ])->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);

        $this->postJson(route('account.profile.update'), [
            'name' => 'Mohamed',
            'email' => 'mohamed@demo.com',
            'phone' => '12345678',
        ])->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);
    }
}
