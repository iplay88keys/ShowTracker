<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UserTypesTableSeeder');
		$this->call('UserTableSeeder');
	}

}

class UserTypesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('types')->delete();

		DB::table('types')->insert(
			array(
				'id' => 1,
				'type' => 'admin'
			)
		);
		DB::table('types')->insert(
			array(
				'id' => 2,
				'type' => 'user'
			)
		);
	}
}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		DB::table('users')->insert(
			array(
				array(
					'username' => 'iplay88keys',
					'email' => 'iplay88keys@comcast.net',
					'user_type' => 1,
					'password' => Hash::make('1234')
				),
				array(
					'username' => 'test',
					'email' => 'test@test.com',
					'user_type' => 2,
					'password' => Hash::make('1234')
				)
			)
		);
	}
}