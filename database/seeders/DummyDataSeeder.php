<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Pages\Database\Seeders\PagesDatabaseSeeder;
use Modules\Countries\Database\Seeders\CountriesTableSeeder;
use Modules\Accounts\Database\Seeders\AccountsDatabaseSeeder;
use Modules\Settings\Database\Seeders\SettingsDatabaseSeeder;
use Modules\Categories\Database\Seeders\CategoryDatabaseSeeder;
use Modules\PaymentMethods\Database\Seeders\PaymentMethodsDatabaseSeeder;
use Modules\Specializations\Database\Seeders\SpecializationsDatabaseSeeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\Module::collections()->has('Countries')) {
            $this->call(CountriesTableSeeder::class);
        }
        $this->call(LaratrustSeeder::class);
        $this->call(AccountsDatabaseSeeder::class);

        if (\Module::collections()->has('Pages')) {
            $this->call(PagesDatabaseSeeder::class);
        }
        // if (\Module::collections()->has('Specializations')) {
        //     $this->call(SpecializationsDatabaseSeeder::class);
        // }
        // if (\Module::collections()->has('PaymentMethods')) {
        //     $this->call(PaymentMethodsDatabaseSeeder::class);
        // }

        if (\Module::collections()->has('Categories')) {
            $this->call(CategoryDatabaseSeeder::class);
        }

        $this->call(SettingsDatabaseSeeder::class);
    }
}
