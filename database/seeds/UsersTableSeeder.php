<?php
namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'name' => 'Administrador do Sistema',
			'email' => 'admin@admin',
			'password' => bcrypt('1234'),
            'admin' => 2
		]);
    }
}
