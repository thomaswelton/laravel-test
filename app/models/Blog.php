<?php

use LaravelBook\Ardent\Ardent;

class Blog extends Ardent
{
	protected $table = 'blog_posts';

	public static $factory = array(
	    'slug' => 'foobar',
	    'title' => 'string',
	    'body' => 'text',
	    'published' => 1,
	);

	public function afterSave()
	{
	    // Clear cache
	    Cache::forget("blog_{$this->id}");
	    die('hi');
	}

	public function findById($id)
	{
		if(Cache::has("blog_{$id}")){
			return Cache::get("blog_{$id}");
		}

		$item = $this->find($id);
		Cache::forever("blog_{$id}", $item);

		return $item;
	}
}