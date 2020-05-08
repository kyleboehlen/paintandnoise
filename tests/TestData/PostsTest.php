<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Models
use App\Models\Posts\Posts;


class PostsTest extends TestCase
{
    /**
     * Seed posts
     *
     * @return void
     * @test
     */
    public function postsTest()
    {
        // Create random posts
        $posts = factory(Posts::class, mt_rand(50, 200))->create(); // Do not go over 250 in case there are not enough posters

        // Verify there are more than 50
        $this->assertTrue(count($posts) >= 50);
    }
}
