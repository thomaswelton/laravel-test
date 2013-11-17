<?php

use Illuminate\Database\Migrations\Migration;

class MigrationCreateBlog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_posts', function($table){

			$table->increments('id');

			$table->string('slug');
			$table->string('title');
			$table->longtext('body');

			$table->integer('published')->unsigned();

			$table->timestamps();
			$table->softDeletes();

			$table->engine = 'InnoDB';
            $table->unique('slug');
            $table->index('title');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blog_posts');
	}


}
