<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration 
{
    public function up()
	{
		Schema::table('file_user', function(Blueprint $table) 
		{
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('file_user', function(Blueprint $table) 
		{
			$table->foreign('file_id')->references('id')->on('files')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('file_user', function(Blueprint $table) 
		{
			$table->dropForeign('file_file_id_foreign');
		});
		Schema::table('file_user', function(Blueprint $table) 
		{
			$table->dropForeign('file_user_user_id_foreign');
		});
	}
}