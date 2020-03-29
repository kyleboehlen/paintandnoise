<?php

namespace App\Models\Posters;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\HasCompositePrimaryKey;

class PostersCategories extends Model
{
    use HasCompositePrimaryKey;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = [
        'posters_id', 'categories_id',
    ];

    protected $fillable = [
        'posters_id', 'categories_id',
    ];
}
