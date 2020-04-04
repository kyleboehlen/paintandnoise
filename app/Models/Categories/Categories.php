<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Users;
use App\Models\Categories\UsersCategories;

class Categories extends Model
{
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
}
