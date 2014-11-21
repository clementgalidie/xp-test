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
		$table->increments('id');
		$table->timestamps();
		$table->string('login', 100)->unique();
		$table->string('email', 100)->unique();
		$table->string('password', 100);
		$table->String('statut',15);
        $table->string('remember_token', 100)->nullable();
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
