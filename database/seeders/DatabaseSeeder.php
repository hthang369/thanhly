<?php

use Database\Seeders\CreateUserSystemAdminSeeder;
use Illuminate\Database\Seeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingDatabaseSeeder::class);
    }
}
