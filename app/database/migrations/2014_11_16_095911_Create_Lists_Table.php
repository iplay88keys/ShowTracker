<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lists', function(Blueprint $table)
                {
                        $table->integer('user_id');
                        $table->integer('series_id');
                        $table->boolean('completed')->default(FALSE);
			$table->timestamps();

                        $table->unique(array('user_id', 'series_id'));
                        $table->foreign('user_id')->references('id')->on('users');
			$table->foreign('series_id')->references('id')->on('series');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lists');
	}

}
