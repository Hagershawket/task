<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('posts', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('posts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('likes', function(Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('posts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('likes', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('posts_tags', function(Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('posts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('posts_tags', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_post_id_foreign');
		});
		Schema::table('likes', function(Blueprint $table) {
			$table->dropForeign('likes_post_id_foreign');
		});
		Schema::table('likes', function(Blueprint $table) {
			$table->dropForeign('likes_user_id_foreign');
		});
		Schema::table('posts_tags', function(Blueprint $table) {
			$table->dropForeign('posts_tags_post_id_foreign');
		});
		Schema::table('posts_tags', function(Blueprint $table) {
			$table->dropForeign('posts_tags_tag_id_foreign');
		});
	}
}