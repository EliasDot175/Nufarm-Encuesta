<?php

use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {


	public function run()
	{
		User::create([
			'username' => 'admin',
			'email' => 'info@ar.nufarm.com',
			'password' => Hash::make('encuestamknet')
		]);
	}

}