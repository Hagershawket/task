<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikesTable extends Migration {

	public function up()
	{
		Schema::create('likes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->boolean('like');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('likes');
	}
}