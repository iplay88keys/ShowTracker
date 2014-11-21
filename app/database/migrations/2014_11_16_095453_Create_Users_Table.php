<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('users', function(Blueprint $table)
                {
                        $table->increments('id')->unique();
                        $table->string('username')->unique();
                        $table->string('email')->unique();
			$table->integer('user_type')->default(1);
                        $table->string('password');
                        $table->string('remember_token')->nullable();
                        $table->timestamps();
			
			$table->foreign('user_type')->references('id')->on('userTypes');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
