<?php
namespace Aashiv\Htmlpdf\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Aashiv\Htmlpdf\Table;
use Aashiv\Htmlpdf\Workspace;

class RowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('rows')->insert([
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;tr&gt;',
			'tTagend' => '&lt;/tr&gt;'
		]);
		
		DB::table('rows')->insert([
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;tr&gt;',
			'tTagend' => '&lt;/tr&gt;'
		]);

		DB::table('rows')->insert([
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;tr&gt;',
			'tTagend' => '&lt;/tr&gt;'
		]);

		DB::table('rows')->insert([
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;tr&gt;',
			'tTagend' => '&lt;/tr&gt;'
		]);		
    }
}
