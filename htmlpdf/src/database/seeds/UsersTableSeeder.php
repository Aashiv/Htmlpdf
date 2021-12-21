<?php
namespace Aashiv\Htmlpdf\Database\Seeds;

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
			'name' => 'ashiv',
			'email' => base64_encode('ashiv@gmail.com'),
			'password' => base64_encode('test')
		]);

		DB::table('users')->insert([
			'name' => 'deep',
			'email' => base64_encode('deep@gmail.com'),
			'password' => base64_encode('test')
		]);

		DB::table('users')->insert([
			'name' => 'manoj',
			'email' => base64_encode('manoj@gmail.com'),
			'password' => base64_encode('test')
		]);		
    }
}
