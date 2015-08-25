<?php

use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {


	public function run()
	{
		User::create([
			'username' => 'admin',
			'email' => '123@domain.com',
			'password' => Hash::make('123')
		]);
	}

}