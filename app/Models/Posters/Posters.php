<?php

namespace App\Models\Posters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Models
use App\Models\Categories\Categories;
use App\Models\Posters\PostersCategories;
use App\Models\Users;

class Posters extends Model
{
    use HasFactory;
    
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function categories()
    {
        return $this->hasManyThrough(Categories::class, PostersCategories::class, 'posters_id', 'id', 'id', 'categories_id');
    }

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'users_id');
    }
}
