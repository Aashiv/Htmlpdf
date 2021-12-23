<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('workspaces')) {
			Schema::create('workspaces', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('vName')->nullable();
				$table->unsignedBigInteger('iUserid');
				$table->text('tTable')->nullable();
				$table->text('tRow')->nullable();
				$table->text('tColumn')->nullable();
				$table->text('tDocname')->nullable();
				$table->timestamp('dtCreatedAt')->useCurrent();
				$table->foreign('iUserid')->references('id')->on('users')->onDelete('cascade');
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspaces');
    }
}
