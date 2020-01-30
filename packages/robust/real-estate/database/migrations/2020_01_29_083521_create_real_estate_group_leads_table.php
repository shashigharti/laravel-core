<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRealEstateGroupLeadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('real_estate_group_leads', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('lead_id');
			$table->integer('group_id');
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
		Schema::drop('real_estate_group_leads');
	}

}