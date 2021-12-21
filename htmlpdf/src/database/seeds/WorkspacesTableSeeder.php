<?php
namespace Aashiv\Htmlpdf\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Aashiv\Htmlpdf\User;

class WorkspacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
		DB::table('workspaces')->insert([
			'vName' => 'wp1',
			'iUserid' =>User::all()->random()->id,
			'tDocname' => 'wp1',
		]);

		DB::table('workspaces')->insert([
			'vName' => 'wp2',
			'iUserid' =>User::all()->random()->id,
			'tDocname' => 'wp2',
		]);

		DB::table('workspaces')->insert([
			'vName' => 'wp3',
			'iUserid' =>User::all()->random()->id,
			'tDocname' => 'wp3',
		]);		
    }
}
