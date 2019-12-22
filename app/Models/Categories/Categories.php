<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Categories\UsersCategories;

class Categories extends Model
{
    public function users()
    {
        return UsersCategories::where('categories_id', $this->id)->get();
    }

    public function usersCount()
    {
        return $this->users()->count();
    }

    public function subCategories()
    {
        return Categories::where('parent_id', $this->id)->get();
    }

    public function subCategoriesCount()
    {
        return $this->subCategories()->count();
    }
}
