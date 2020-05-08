<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\HasCompositePrimaryKey;

class Votes extends Model
{
    use HasCompositePrimaryKey;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = [
        'posts_id', 'users_id',
    ];

    protected $fillable = [
        'posts_id', 'users_id',
    ];
}
