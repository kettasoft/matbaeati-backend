<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Accounts\Entities\Customer;
use Modules\Articles\Entities\Article;
use Modules\Pages\Entities\Page;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::reguard();

        config(['mail.default' => 'array']);

        $count = (int)$this->command->option('count');
        $small_count = ($count <= 10) ? $count : 10;

        $this->command->info('Creating sample data...');

        $bar = $this->command->getOutput()->createProgressBar(7);
        $bar->setFormat('verbose');

        $bar->start();

        Customer::factory()->count($small_count)->create();
        $bar->advance();

        Page::factory()->count($count)->create();
        $bar->advance();

        Article::factory()->count($count)->create();
        $bar->advance();

        $bar->finish();

        $this->command->info('');
        $this->command->info('Sample data created.');

        Model::unguard();
    }
}
