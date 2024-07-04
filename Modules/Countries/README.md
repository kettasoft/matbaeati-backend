# Countries Module
> This module references to [scaffolding](https://github.com/laravel-modules/scaffolding) project.

## Usage
> Clone the repository as name `Countries` and copy the module folder into `Modules` in [scaffolding](https://github.com/laravel-modules/scaffolding) project.

```bash
cd /path/to/project

git clone https://github.com/laravel-modules/countries Modules/Countries
```
> Do not forget to remove `.git` folder.

```bash
rm -rf Modules/Countries/.git
```
> Add the module into `modules_statuses.json` file.
```json
{
    "Accounts": true,
    "Dashboard": true,
    "Countries": true
}
```

> Add the seeders to `DummyDataSeeder`

```php
<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ...
        $this->call(CountriesTableSeeder::class);
    }
}
```
> Add countries link to dashboard sidebar `Modules/Dashboard/Resources/views/sidebar.blade.php`

```blade
@include('countries::sidebar')
```

> Now you should update the composer packages.

```bash
composer update
```
> Migrate the tables.

```bash
php artisan migrate:fresh --seed
```