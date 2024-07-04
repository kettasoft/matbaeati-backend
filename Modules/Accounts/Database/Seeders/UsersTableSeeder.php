<?php

namespace Modules\Accounts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Countries\Entities\City;
use Illuminate\Support\Facades\Schema;
use Modules\Countries\Entities\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Entities\User;

class UsersTableSeeder extends Seeder
{
    use HasFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $root = \Modules\Accounts\Entities\Admin::firstOrCreate([
            'email' => 'root@demo.com',
        ], \Modules\Accounts\Entities\Admin::factory()->raw([
            'name' => 'Root',
            'email' => 'root@demo.com',
            'phone' => '01156382044',
            'preferred_locale' => 'ar',
            'status' => User::APPROVED_STATUS
        ]));

        $root->addRole('super_admin');

        $root->setVerified();

        $admin = \Modules\Accounts\Entities\Admin::firstOrCreate([
            'email' => 'admin@demo.com',
        ], \Modules\Accounts\Entities\Admin::factory()->raw([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'phone' => '987654123',
            'preferred_locale' => 'en',
            'status' => User::APPROVED_STATUS
        ]));

        $admin->addRole('super_admin');

        $admin->setVerified();

        $customer = \Modules\Accounts\Entities\Customer::firstOrCreate([
            'email' => 'customer@demo.com',
        ], \Modules\Accounts\Entities\Customer::factory()->raw([
            'name' => 'Customer',
            'email' => 'customer@demo.com',
            'phone' => '01552416535',
            'preferred_locale' => 'en',
            'status' => User::APPROVED_STATUS
        ]));

        $customer->setVerified();

        $consumer = \Modules\Accounts\Entities\Consumer::firstOrCreate([
            'email' => 'consumer@demo.com',
        ], \Modules\Accounts\Entities\Consumer::factory()->raw([
            'name' => 'Consumer',
            'email' => 'consumer@demo.com',
            'phone' => '01023331690',
            'preferred_locale' => 'en',
            'status' => User::APPROVED_STATUS
        ]));


        $consumer->data()->create([
            'name' => 'kettasoft',
            'company_name' => 'kettasoft',
            'person_name' => 'Abdalrhman Emad Saad',
            'website' => 'https;//kettasoft.com',
            'license_number' => rand(1000000000, 9999999999),
            'tax_registration_number' => rand(1000000000, 999999999999999),
            'country_id' => Country::firstOr(fn() => Country::factory()->create())->id,
            'city_id' => City::firstOr(fn() => City::factory()->create())->id,
        ]);

        $consumer->addRole('consumer');

        $consumer->setVerified();

        $supplier = \Modules\Accounts\Entities\Supplier::firstOrCreate([
            'email' => 'supplier@demo.com',
        ], \Modules\Accounts\Entities\Supplier::factory()->raw([
            'name' => 'Supplier',
            'email' => 'supplier@demo.com',
            'phone' => '01012172469',
            'preferred_locale' => 'en',
        ]));

        $supplier->data()->create([
            'name' => 'kettasoft',
            'company_name' => 'kettasoft',
            'person_name' => 'Abdalrhman Emad Saad',
            'website' => 'https;//kettasoft.com',
            'license_number' => rand(1000000000, 9999999999),
            'tax_registration_number' => rand(1000000000, 999999999999999),
            'country_id' => Country::firstOr(fn() => Country::factory()->create()->id)->id,
            'city_id' => City::firstOr(fn() => City::factory()->create())->id,
        ]);

        $supplier->addRole('supplier');

        $supplier->setVerified();
    }
}
