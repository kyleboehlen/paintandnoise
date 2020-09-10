<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Log;

// Models
use App\Models\Categories\Categories;
use App\Models\Posters\Posters;
use App\Models\Posts\Votes;

class Posts extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    
    public function cacheVotes()
    {
        // Cache total votes
        $this->total_votes = Votes::where('posts_id', $this->id)->count();

        if(!$this->save())
        {
            Log::warning('Failed to cache total votes for post.', [
                'posts_id' => $this->id
            ]);
        }

        // Calculate trending score
        $this->trending_score = $this->total_votes / Carbon::now()->diffInMinutes(Carbon::parse($this->created_at));

        if(!$this->save())
        {
            Log::warning('Failed to calculate trending score for post.', [
                'posts_id' => $this->id
            ]);
        }
    }

    // Poster
    public function poster()
    {
        return $this->hasOne(Posters::class, 'id', 'posters_id');
    }

    // Category
    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'categories_id');
    }
}
