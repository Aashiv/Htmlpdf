<?php

namespace Aashiv\Htmlpdf;

use Illuminate\Support\ServiceProvider;
use htmlpdf\Connection;

class HtmlpdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Aashiv\Htmlpdf\Controllers\HtmlpdfController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		if (!$this->app->routesAreCached()) {
			require __DIR__.'/routes.php';
		}
		
		$this->loadViewsFrom(__DIR__.'/views', 'htmlpdf');
	
		$this->publishes([
			__DIR__.'/Database/Migrations' => $this->app->databasePath().'/migrations',
			__DIR__.'/Database/Seeds/UsersTableSeeder.php' => $this->app->databasePath().'/seeds/UsersTableSeeder.php',
			__DIR__.'/Database/Seeds/WorkspacesTableSeeder.php' => $this->app->databasePath().'/seeds/WorkspacesTableSeeder.php',
			__DIR__.'/Database/Seeds/TablesTableSeeder.php' => $this->app->databasePath().'/seeds/TablesTableSeeder.php',
			__DIR__.'/Database/Seeds/RowsTableSeeder.php' => $this->app->databasePath().'/seeds/RowsTableSeeder.php',
			__DIR__.'/Database/Seeds/ColumnsTableSeeder.php' => $this->app->databasePath().'/seeds/ColumnsTableSeeder.php'
		]);
    }
}
