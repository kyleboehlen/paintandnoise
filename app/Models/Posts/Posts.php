<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Log;

// Models
use App\Models\Posts\Votes;

class Posts extends Model
{
    public function cacheVotes()
    {
        $this->total_votes = Votes::where('posts_id', $this->id)->count();

        if($this->save())
        {
            Log::warning('Failed to cache votes for post.', [
                'posts_id' => $this->id
            ]);
        }
    }
}
