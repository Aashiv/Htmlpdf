<?php
namespace Aashiv\Htmlpdf\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Aashiv\Htmlpdf\Row;
use Aashiv\Htmlpdf\Table;
use Aashiv\Htmlpdf\Workspace;

class ColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('columns')->insert([
			'iRowid' =>Row::all()->random()->id,
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;td style=&quot;width:50%; width:540.00px; font-size:20px;&quot;&gt;&lt;h1 style=&quot;font-size:45px; font-weight:bold;&quot;&gt;[Company 1Name]&lt;/h1&gt;&lt;br&gt;
[Street Address], [City. ST ZIP Code]&lt;br&gt;
[Phone: 555-555-55555] [Fax: 123-123-123456]&lt;br&gt;
[abc@example.com]&lt;/td&gt;',
			'tTagend' => '&lt;/td&gt;'
		]);
		
		DB::table('columns')->insert([
			'iRowid' =>Row::all()->random()->id,
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;td style=&quot;width:50%; width:540.00px; font-size:20px;&quot;&gt;&lt;h1 style=&quot;font-size:45px; font-weight:bold;&quot;&gt;[Company 1Name]&lt;/h1&gt;&lt;br&gt;
[Street Address], [City. ST ZIP Code]&lt;br&gt;
[Phone: 555-555-55555] [Fax: 123-123-123456]&lt;br&gt;
[abc@example.com]&lt;/td&gt;',
			'tTagend' => '&lt;/td&gt;'
		]);

		DB::table('columns')->insert([
			'iRowid' =>Row::all()->random()->id,
			'iTableid' =>Table::all()->random()->id,
			'iWorkspaceid' =>Workspace::all()->random()->id,
			'tTagstart' => '&lt;td style=&quot;width:50%; width:540.00px; font-size:20px;&quot;&gt;&lt;h1 style=&quot;font-size:45px; font-weight:bold;&quot;&gt;[Company 1Name]&lt;/h1&gt;&lt;br&gt;
[Street Address], [City. ST ZIP Code]&lt;br&gt;
[Phone: 555-555-55555] [Fax: 123-123-123456]&lt;br&gt;
[abc@example.com]&lt;/td&gt;',
			'tTagend' => '&lt;/td&gt;'
		]);		
    }
}
