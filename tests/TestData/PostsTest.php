<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

// Models
use App\Models\Users;
use App\Models\Posters\Posters;
use App\Models\Posts\Posts;
use App\Models\Posts\Votes;


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
        $posts = 
            Posts::factory(
                mt_rand(
                    intval(Posters::all()->count() * config('test.min_percent_posters_post')),
                    intval(Posters::all()->count() * config('test.max_percent_posters_post'))
                )
            )->create();

        // Verify there are the correct amount
        $this->assertTrue(count($posts) >= intval(Posters::all()->count() * config('test.min_percent_posters_post')));
    }

    /**
     * Seed posts votes
     *
     * @return void
     * @test
     */
    public function postsVotesTest()
    {
        // Create at least one vote per post
        $posts = Posts::all();
        $users = Users::all();

        $insert = array();
        foreach($posts as $post)
        {
            foreach($users->random(mt_rand(1, intval($users->count() / 10))) as $user)
            {
                array_push($insert, [
                    'posts_id' => $post->id,
                    'users_id' => $user->id,
                ]);
            }
        }

        foreach(array_chunk($insert, config('app.chunk_insert_size')) as $chunk_insert)
        {
            Votes::insert($chunk_insert);
        }

        $this->assertTrue(Votes::all()->count() >= count($posts));
    }

    /**
     * Cache total votes
     *
     * @return void
     * @test
     */
    public function cacheVotesTest()
    {
        Artisan::call('votes:cache');
        $this->assertTrue(Posts::all()->sum('total_votes') > 0);
    }
}
