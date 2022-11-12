<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotosTable extends Migration {

	public function up()
	{
		Schema::create('photos', function(Blueprint $table) {
			$table->increments('id');
			$table->morphs('photo');
			$table->string('data', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('photos');
	}
}