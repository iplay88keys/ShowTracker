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
<<<<<<< HEAD
		$this->call('UserTableSeeder');
		$this->call('UserTypesTableSeeder');
=======
		$this->call('UserTypesTableSeeder');
		$this->call('UserTableSeeder');
>>>>>>> 8c41ed1242a8e7b6c109b17e981da5a50a10514b
	}

}

<<<<<<< HEAD
class UserTableSeeder extends Seeder {

    	public function run()
    	{
=======
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
>>>>>>> 8c41ed1242a8e7b6c109b17e981da5a50a10514b
		DB::table('users')->delete();

		DB::table('users')->insert(
			array(
				array(
					'username' => 'iplay88keys',
					'email' => 'iplay88keys@comcast.net',
<<<<<<< HEAD
=======
					'user_type' => 1,
>>>>>>> 8c41ed1242a8e7b6c109b17e981da5a50a10514b
					'password' => Hash::make('1234')
				),
				array(
					'username' => 'test',
					'email' => 'test@test.com',
<<<<<<< HEAD
=======
					'user_type' => 2,
>>>>>>> 8c41ed1242a8e7b6c109b17e981da5a50a10514b
					'password' => Hash::make('1234')
				)
			)
		);
<<<<<<< HEAD
    	}	
}

class UserTypesTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('userTypes')->delete();
		
		DB::table('userTypes')->insert(
			array(
				array(
					'type' => 'admin'
				),
				array(
					'type' => 'user'
				)
			)
		);
	}
}
=======
	}
}
>>>>>>> 8c41ed1242a8e7b6c109b17e981da5a50a10514b
