<?php

namespace App\Console\Commands\Posts;

use Illuminate\Console\Command;
use Log;

// Models
use App\Models\Posts\Posts;

class Delete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all posts outside of the POSTS_TIMEOUT env var.';

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
     * @return int
     */
    public function handle()
    {
        $posts = Posts::all();

        $failures = 0;
        foreach($posts as $post)
        {
            // Check if post is expired
            if($post->isExpired())
            {
                if(!$post->delete())
                {
                    // Log warning
                    Log::warning('Failed to delete expired post.', [
                        'posts_id' => $post->id
                    ]);

                    $failures++;
                }
            }
        }

        $message = "Deleted expired posts. $failures failures.";
        Log::info($message);
        echo $message . "\n";
    }
}
