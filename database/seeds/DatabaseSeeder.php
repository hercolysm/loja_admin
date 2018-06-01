<?php

use Illuminate\Database\Seeder;
use database\seeds\UsersTableSeeder;
use database\seeds\AclPermissionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AclPermissionsTableSeeder::class);
    }
}
