<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->string('title');
			$table->string('url');
			$table->string('area', 191)->nullable();
			$table->string('slug');
			$table->integer('parent')->nullable();
			$table->string('page_type')->nullable();
			$table->string('default_filters')->nullable();
			$table->string('meta_title')->nullable();
			$table->string('meta_description', 500)->nullable();
			$table->string('meta_keywords', 500)->nullable();
			$table->text('content', 65535)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}