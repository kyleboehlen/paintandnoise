<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

use App\Models\Categories\UsersCategories;

class Categories extends Model
{
    public function userCount()
    {
        return UsersCategories::where('categories_id', $this->id)->get()->count();
    }
}
