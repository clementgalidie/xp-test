<?php

class UserTableSeeder extends Seeder {

    public function run()
	{
				DB::table('users')->insert(array(
					'email' => 'toast@blop.fr',
					'password' => Hash::make('mdp'),
					'login' => 'eddyMalou',
					'statut' => 'utilisateur'
				));


	}
}