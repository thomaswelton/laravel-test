<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class BlogTest extends TestCase {

	public function testFindByIdReadsFromCache()
	{
		Cache::put("blog_1", 'bar', 5);

		$blog = App::make('Blog')->findById(1);

		$this->assertEquals('bar', $blog);
	}

	public function testBlogFindSetsCacheKey()
	{
		$blog = FactoryMuff::create('Blog');

		App::make('Blog')->findById($blog->id);

		$this->assertTrue(Cache::has("blog_{$blog->id}"));
	}

	public function testBlogUpdateClearsCache()
	{
		$blog = FactoryMuff::create('Blog');

		Cache::put("blog_{$blog->id}", 'bar', 5);

		$blog->body = 'Updated body';
		$blog->save();

		$this->assertFalse(Cache::has("blog_{$blog->id}"));
	}

}