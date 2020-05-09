<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

// Models
use App\Models\Users;
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
        $posts = factory(Posts::class, mt_rand(50, 200))->create(); // Do not go over 250 in case there are not enough posters

        // Verify there are more than 50
        $this->assertTrue(count($posts) >= 50);
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

        foreach($posts as $post)
        {
            for($i = 0; $i < mt_rand(1, intval($users->count() / 10)); $i++)
            {
                $user = $users->random();
                $ids = array(
                    'posts_id' => $post->id,
                    'users_id' => $user->id,
                );
                $vote = new Votes($ids);
                try
                {
                    $vote->save();
                }
                catch(\Exception $e)
                { /* skipping duplicate relationship */ }
            }
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
