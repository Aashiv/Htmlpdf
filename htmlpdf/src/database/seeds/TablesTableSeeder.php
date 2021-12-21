<?php
namespace Aashiv\Htmlpdf\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Aashiv\Htmlpdf\Workspace;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('tables')->insert([
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;table style=&quot;width:100%; border-collapse:collapse;&quot; border=&quot;1&quot;&gt;',
			'tTagend' => '&lt;/table&gt;'
		]);

		DB::table('tables')->insert([
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;table style=&quot;width:100%; border-collapse:collapse;&quot; border=&quot;1&quot;&gt;',
			'tTagend' => '&lt;/table&gt;'
		]);

		DB::table('tables')->insert([
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;table style=&quot;width:100%; border-collapse:collapse;&quot; border=&quot;1&quot;&gt;',
			'tTagend' => '&lt;/table&gt;'
		]);		
    }
}
