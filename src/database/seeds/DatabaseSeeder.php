<?php
namespace Aashiv\Htmlpdf\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		Model::unguard();
        
		$this->call(UsersTableSeeder::class);
        $this->call(WorkspacesTableSeeder::class);
        $this->call(TablesTableSeeder::class);
        $this->call(RowsTableSeeder::class);
        $this->call(ColumnsTableSeeder::class);
		
		Model::reguard();
    }
}
