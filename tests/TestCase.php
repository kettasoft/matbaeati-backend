<?php

namespace Tests;

use Modules\Accounts\Entities\Admin;
use Database\Seeders\LaratrustSeeder;
use Modules\Accounts\Entities\Office;
use Modules\Accounts\Entities\Account;
use Modules\Accounts\Entities\PrintingPress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use Modules\Countries\Database\Seeders\CountriesTableSeeder;
use Modules\Categories\Database\Seeders\CategoryDatabaseSeeder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Set the currently logged in admin for the application.
     *
     * @param $driver
     * @return Admin
     */
    public function actingAsAdmin($driver = null): Admin
    {
        $this->seed(LaratrustSeeder::class);

        $admin = Admin::factory()->create([
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'status' => Account::APPROVED_STATUS
        ]);

        $admin->addRole('super_admin');

        Sanctum::actingAs($admin);

        return $admin;
    }

    /**
     * Set the currently logged in Office for the application.
     *
     * @param $driver
     * @return Office
     */
    public function actingAsOffice($driver = null): Office
    {
        $this->seed(LaratrustSeeder::class);

        $offic = Office::factory()->create([
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'status' => Account::APPROVED_STATUS
        ]);

        $offic->addRole('office');

        Sanctum::actingAs($offic);

        return $offic;
    }


    /**
     * Set the currently logged in Printing press for the application.
     *
     * @param $driver
     * @return PrintingPress
     */
    public function actingAsPrintPress($driver = null): PrintingPress
    {
        $this->seed(LaratrustSeeder::class);

        $printingPress = PrintingPress::factory()->create([
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'status' => Account::APPROVED_STATUS
        ]);

        $printingPress->addRole('office');

        Sanctum::actingAs($printingPress);

        return $printingPress;
    }

    public function runItemsManagement()
    {
        $this->seed(CategoryDatabaseSeeder::class);
        $this->seed(CountriesTableSeeder::class);
    }
}
