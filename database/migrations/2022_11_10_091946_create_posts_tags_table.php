<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTagsTable extends Migration {

	public function up()
	{
		Schema::create('posts_tags', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('posts_tags');
	}
}