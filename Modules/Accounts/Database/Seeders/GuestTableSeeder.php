<?php

namespace Modules\Accounts\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Accounts\Entities\Customer;
use Modules\Accounts\Entities\User;

class GuestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guest = Customer::create([
            'name' => 'guest',
            'type' => User::CUSTOMER_TYPE,
            'email' => 'guest@guest.com',
            'phone' => '0000000000',
            'email_verified_at' => Carbon::now(),
            'password' => \Hash::make('password')
        ]);
    }
}
