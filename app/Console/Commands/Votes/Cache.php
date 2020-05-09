<?php

namespace App\Console\Commands\Votes;

use Illuminate\Console\Command;
use Log;

// Models
use App\Models\Posts\Posts;

class Cache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'votes:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache the total number of votes for each post.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $posts = Posts::all();

        foreach($posts as $post)
        {
            $post->cacheVotes();
        }

        Log::info('Cached votes for posts.');
    }
}
