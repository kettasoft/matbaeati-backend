<?php

namespace Modules\Accounts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Entities\Account;

class AccountsDatabaseSeeder extends Seeder
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
            'status' => Account::APPROVED_STATUS
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
            'status' => Account::APPROVED_STATUS
        ]));

        $admin->addRole('super_admin');

        $admin->setVerified();

        $office = \Modules\Accounts\Entities\Office::firstOrCreate([
            'email' => 'office@demo.com',
        ], \Modules\Accounts\Entities\Office::factory()->raw([
            'name' => 'Office',
            'email' => 'office@demo.com',
            'phone' => '01552416535',
            'preferred_locale' => 'en',
            'status' => Account::APPROVED_STATUS
        ]));

        $admin->addRole('office');

        $office->setVerified();

        $printingPress = \Modules\Accounts\Entities\PrintingPress::firstOrCreate([
            'email' => 'printingpress@demo.com',
        ], \Modules\Accounts\Entities\PrintingPress::factory()->raw([
            'name' => 'PrintingPress',
            'email' => 'printingpress@demo.com',
            'phone' => '01023331690',
            'preferred_locale' => 'en',
            'status' => Account::APPROVED_STATUS
        ]));

        $printingPress->addRole('printing_press');
    }
}
