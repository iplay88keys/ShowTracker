<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('types', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->string('type');
		});

        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
			$table->unsignedInteger('user_type')->default(1);
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->timestamps();

			$table->foreign('user_type')->references('id')->on('types');
        });

        Schema::create('series', function(Blueprint $table)
		{
			$table->integer('id')->unique();;
			$table->string('name');
			$table->string('banner');
			$table->mediumText('overview');
			$table->string('status');
			$table->timestamps();
		});

		Schema::create('episodes', function(Blueprint $table)
		{
			$table->unsignedInteger('user_id');
			$table->integer('episode_id');
			$table->integer('series_id');
			$table->timestamps();

			$table->unique(array('user_id', 'episode_id'));
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('series_id')->references('id')->on('series');
		});

		Schema::create('lists', function(Blueprint $table)
        {
            $table->unsignedInteger('user_id');
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
		Schema::drop('episodes');
		Schema::drop('series');
		Schema::drop('users');
		Schema::drop('types');
	}

}
