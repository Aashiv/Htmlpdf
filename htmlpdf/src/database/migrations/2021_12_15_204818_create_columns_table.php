<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('columns')) {
			Schema::create('columns', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('iRowid');
				$table->unsignedBigInteger('iTableid');
				$table->unsignedBigInteger('iWorkspaceid');
				$table->text('tTagstart')->nullable();
				$table->text('tTagend')->nullable();
				$table->text('tHtml')->nullable();
				$table->text('tJson')->nullable();
				$table->string('iWidthpx')->nullable();
				$table->string('iWidthcent')->nullable();
				$table->timestamp('dtCreatedAt')->useCurrent();
				$table->foreign('iRowid')->references('id')->on('rows')->onDelete('cascade');
				$table->foreign('iTableid')->references('id')->on('tables')->onDelete('cascade');
				$table->foreign('iWorkspaceid')->references('id')->on('workspaces')->onDelete('cascade');
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
        Schema::dropIfExists('columns');
    }
}
