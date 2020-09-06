<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Users;
use App\Models\Categories\UsersCategories;
use App\Models\Posts\Posts;

class Categories extends Model
{
    public $timestamps = false;
    
    public function users()
    {
        return $this->belongsToMany(Users::class, UsersCategories::class);
    }

    public function usersCount()
    {
        return $this->users()->count();
    }

    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function subCategoriesCount()
    {
        return $this->subCategories()->count();
    }

    public function postsTypesIds()
    {
        $categories_posts_types = CategoriesPostsTypes::where('categories_id', $this->id)->get();

        if($categories_posts_types->count() == 0)
        {
            $categories_posts_types = CategoriesPostsTypes::where('categories_id', $this->parent_id)->get();
        }

        return $categories_posts_types->pluck('types_id')->toArray();
    }
}
