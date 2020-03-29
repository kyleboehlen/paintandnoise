<?php

namespace App\Models\Posters;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\HasCompositePrimaryKey;

class PostersSocials extends Model
{
    use HasCompositePrimaryKey;

    public $incrementing = false;

    protected $primaryKey = [
        'posters_id', 'socials_id',
    ];

    protected $fillable = [
        'posters_id', 'socials_id', 'value', 'verified',
    ];
}
